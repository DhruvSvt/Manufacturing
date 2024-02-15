<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production;
use App\Models\ProductStock;
use App\Models\ReturnGood;
use App\Models\ReturnGoodsProduct;
use App\Models\Suppliers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReturnController extends Controller
{
    public function good_return()
    {

        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = ReturnGood::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new ReturnGood())->getTable());
        $allSuppliersColumns = Schema::getColumnListing((new Suppliers())->getTable());

        $returns = ReturnGood::with('supplier')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allSuppliersColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            "%$keyword%"
                        );
                    }
                });

                // searching from suppliers
                $query->orWhereHas('supplier', function ($query) use ($keyword, $allSuppliersColumns) {
                    $query->where(function ($query) use ($keyword, $allSuppliersColumns) {
                        foreach ($allSuppliersColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        // $returns = ReturnGood::latest()->get();
        // $returnProducts = ReturnGoodsProduct::all();
        return view('admin.returns.good-return', compact('returns'));
    }

    public function good_return_create()
    {
        $suppilers = Suppliers::all();
        $products = Product::all();
        return view('admin.returns.good-return-create', compact('suppilers', 'products'));
    }

    public function good_return_store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'builty' => 'required',
            'transport' => 'required',
            'dispatch' => 'required',
            'date_of_receipt' => 'required',
            'receipt' => 'required',
        ]);

        $products = json_decode(request()->products);

        // Validate all products
        // foreach($products as $item){
        //     $request->validate([
        //         $item->product_id => 'required',
        //         $item->quantity => 'required',
        //         $item->rate => 'required',
        //         $item->batch => 'required',
        //         $item->type => 'required',
        //     ]);
        // }

        // checking - is the product or batch no match with our database
        foreach ($products as $item) {

            if ($stock = Production::where('batch_no', $item->batch)->first()) {

                try {
                    if ($item->product_id == $stock->product_id) {

                        // checking for stocks
                        $expiry_date = $stock->expiry_date;
                        $current_date = \Carbon\Carbon::now();

                        if ($expiry_date > $current_date) {

                            // Update in ProductionStock
                            $product_stock = ProductStock::where('purchase_id', $stock->id)->first();
                            $product_stock->quantity += $item->quantity;
                            $product_stock->save();
                        }
                    } else {
                        return redirect()->back()->with('error', 'Your Product and Batch No. (' . $item->batch . ') not matches with our records !!');
                    }
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Something went wrong try again later  ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'This Batch No. (' . $item->batch . ') not matches with our records !!');
            }
        }

        $returnDetails = new ReturnGood;
        $returnDetails->supplier_id = $request->supplier_id;
        $returnDetails->builty = $request->builty;
        $returnDetails->transport = $request->transport;
        $returnDetails->dispatch = $request->dispatch;
        $returnDetails->date_of_receipt = $request->date_of_receipt;
        $returnDetails->receipt = $request->receipt;
        $returnDetails->save();

        foreach ($products as $item) {
            $returnGood = new ReturnGoodsProduct;
            $returnGood->return_good_id = $returnDetails->id;
            $returnGood->product_id = $item->product_id;
            $returnGood->qty = $item->quantity;
            $returnGood->rate = $item->rate;
            $returnGood->batch_no = $item->batch;
            $returnGood->reason_of_return = $item->type;
            $returnGood->save();
        }

        return redirect()->route('good-return')->with('success', 'Return Good Create Successfully.');
    }

    public function print($id)
    {
        $return = ReturnGood::findOrFail($id);
        $returnProducts = ReturnGoodsProduct::where('return_good_id', $id)->get();

        // Calculating grand total
        $total = 0;
        $grandTotal = 0;
        foreach ($returnProducts as $item) {
            $total = $item->rate * $item->qty;
            $grandTotal += $total;
        }
        return view('admin.returns.pdf', compact('return', 'returnProducts', 'grandTotal'));
    }
}
