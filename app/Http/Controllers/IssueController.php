<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use App\Models\Gift;
use App\Models\GiftIssue;
use App\Models\Headquarters;
use App\Models\ItemStock;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductStock;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function gift_index()
    {

        $gifts = Gift::whereStatus(true)->get();
        $party = Suppliers::whereStatus(true)->get();
        $hq_name = Headquarters::whereStatus(true)->get();

        $issues = GiftIssue::latest()->get();
        return view('admin.challans.gift', compact('party', 'hq_name', 'gifts', 'issues'));
    }

    public function gift_store(Request $request)
    {

        $request->validate([
            'gift' => 'required',
            'party' => 'required',
            'headquarter' => 'required',
            'qty' => 'required',
            'amount' => 'required',
        ]);

        $qty = $request->qty ?? 0;

        $giftIssue = new GiftIssue([
            'gift_id' => $request->gift,
            'supplier_id' => $request->party,
            'headquarter_id' => $request->headquarter,
            'qty' => $qty,
            'amount' => $request->amount
        ]);


        $gifts = ItemStock::where('item_id', $request->gift)->get();

        if ($gifts->count() > 0) {
            $canIssue = true;

            foreach ($gifts as $gift) {

                $giftStock = ItemStock::where('item_id', $request->gift)
                    ->where('expiry_date', '>', \Carbon\Carbon::now())
                    ->whereOr('quantity', '>', 0)
                    ->groupBy('item_id')
                    ->selectRaw('sum(quantity) as total_quantity, item_id')
                    ->first();

                if (!isset($giftStock) || $giftStock->total_quantity < $qty) {
                    $canIssue = false;
                    break; // Stop checking other materials if one is not available
                }
            }
        } else {
            $canIssue = false;
        }

        if ($canIssue) {

            $giftIssue->save();

            // Update the raw material stock
            try {
                foreach ($gifts as $gift) {
                    // $actual_qty = $qty * $gift->qty;

                    $giftStocks = ItemStock::where('item_id', $request->gift)
                        ->where('expiry_date', '>', \Carbon\Carbon::now())
                        ->orderBy('expiry_date')
                        ->get();

                    foreach ($giftStocks as $item) {
                        if ($qty > 0)
                            if ($item->quantity >= $qty) {
                                $item->quantity -= $qty;
                                $qty = 0;
                                $item->save();
                            } else {
                                $qty -= $item->quantity;
                                $item->quantity = 0;
                                $item->save();
                            }
                    }
                }

                return redirect()->route('gift-challan')->with('success', 'Gift Issue successfully.');
            } catch (\Exception $e) {
                // Handle exceptions here
                return redirect()->back()->with('error', 'Error updating gift stock: ' . $e->getMessage());
            }
        } else {
            $needQuantity = $qty - ($giftStock->total_quantity ?? 0);
            return redirect()->back()->with([
                'error' => 'Insufficient Gift stock to issue Challan.',
                'needQuantity' => $needQuantity
            ]);
        }
    }

    public function raw_material_index()
    {
        $issues = Production::with(['finish_raw_material', 'product_raw_material'])->whereStatus(true)->latest()->get();

        return view('admin.challans.raw-material', compact('issues'));
    }

    public function finish_good_index()
    {
        $products = Product::all();
        $party = Suppliers::whereStatus(true)->get();
        $hq_name = Headquarters::whereStatus(true)->get();

        $issues = FinishGood::latest()->get();
        return view('admin.challans.finish', compact('products', 'party', 'hq_name','issues'));
    }

    public function finish_good_store(Request $request)
    {

        $request->validate([
            'product' => 'required',
            'party' => 'required',
            'place' => 'required',
            'qty' => 'required',
        ]);

        $qty = $request->qty ?? 0;

        $goodIssue = new FinishGood([
            'product_id' => $request->product,
            'supplier_id' => $request->party,
            'headquarter_id' => $request->place,
            'qty' => $qty,
        ]);


        $products = ProductStock::where('product_id', $request->product)->get();

        if ($products->count() > 0) {
            $canIssue = true;

            foreach ($products as $product) {

                $productStock = ProductStock::where('product_id', $request->product)
                    ->where('expiry_date', '>', \Carbon\Carbon::now())
                    ->whereOr('quantity', '>', 0)
                    ->groupBy('product_id')
                    ->selectRaw('sum(quantity) as total_quantity, product_id')
                    ->first();

                if (!isset($productStock) || $productStock->total_quantity < $qty) {
                    $canIssue = false;
                    break; // Stop checking other materials if one is not available
                }
            }
        }
        else {
            $canIssue = false;
        }

        if ($canIssue) {

            $goodIssue->save();

            // Update the raw material stock
            try {
                foreach ($products as $product) {
                    // $actual_qty = $qty * $gift->qty;

                    $productStock = ProductStock::where('product_id', $request->product)
                        ->where('expiry_date', '>', \Carbon\Carbon::now())
                        ->orderBy('expiry_date')
                        ->get();

                    foreach ($productStock as $item) {
                        if ($qty > 0){
                            if ($item->quantity >= $qty) {
                                $item->quantity -= $qty;
                                $qty = 0;
                                $item->save();
                            } else {
                                $qty -= $item->quantity;
                                $item->quantity = 0;
                                $item->save();
                            }
                        }
                    }
                }

                return redirect()->route('finish-good-challan')->with('success', 'Finish-Good Issue successfully.');
            } catch (\Exception $e) {
                // Handle exceptions here
                return redirect()->back()->with('error', 'Error updating gift stock: ' . $e->getMessage());
            }
        } else {
            $needQuantity = $qty - ($productStock->total_quantity ?? 0);
            return redirect()->back()->with([
                'error' => 'Insufficient Finish Good stock to issue Challan.',
                'needQuantity' => $needQuantity
            ]);
        }
    }
}
