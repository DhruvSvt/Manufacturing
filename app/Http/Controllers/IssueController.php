<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FinishGood;
use App\Models\Gift;
use App\Models\GiftIssue;
use App\Models\Headquarters;
use App\Models\ItemStock;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductStock;
use App\Models\Sample;
use App\Models\SampleIssue;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function gift_index()
    {

        $gifts = Gift::whereStatus(true)->get();
        $party = Suppliers::whereStatus(true)->get();
        $hq_name = Headquarters::whereStatus(true)->get();
        $employees = Employee::whereStatus(true)->get();

        $issues = GiftIssue::latest()->get();
        return view('admin.challans.gift', compact('party', 'hq_name', 'gifts', 'issues','employees'));
    }

    public function gift_create()
    {

        $gifts = Gift::whereStatus(true)->get();
        $party = Suppliers::whereStatus(true)->get();
        $hq_name = Headquarters::whereStatus(true)->get();
        $employees = Employee::whereStatus(true)->get();

        return view('admin.challans.gift-create', compact('party', 'hq_name', 'gifts','employees'));
    }

    public function gift_store(Request $request)
    {
        $request->validate([
            'gift' => 'required',
            'party' => 'required',
            'headquarter' => 'required',
            'employee_id' => 'required',
            'qty' => 'required',
            'amount' => 'required',
        ]);
        $qty = $request->qty ?? 0;

        $giftIssue = new GiftIssue([
            'gift_id' => $request->gift,
            'supplier_id' => $request->party,
            'headquarter_id' => $request->headquarter,
            'employee_id' => $request->employee_id,
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
            return redirect()->route('gift-challan')->with([
                'error' => 'Insufficient Gift stock to issue Challan.',
                'needQuantity' => $needQuantity
            ]);
        }
    }

    public function raw_material_index()
    {
        $issues = Production::with(['finish_raw_material', 'product_raw_material'])->latest()->get();

        return view('admin.challans.raw-material', compact('issues'));
    }

    public function complete_good()
    {
        $productions = Production::whereStatus(true)->latest()->get();
        return view('admin.challans.complete-good', compact('productions'));
    }

    public function sample()
    {
        $samples = SampleIssue::all();

        $products = Product::whereStatus(true)->get();
        $party = Suppliers::whereStatus(true)->get();
        $hqs = Headquarters::whereStatus(true)->get();

        return view('admin.challans.sample',compact('samples','products','party','hqs'));
    }

    public function sample_store(Request $request)
    {
        $request->validate([
            'sample' => 'required',
            'party' => 'required',
            'headquarter' => 'required',
            'qty' => 'required',
        ]);

        $qty = $request->qty ?? 0;

        $sampleIssue = new SampleIssue([
            'product_id' => $request->sample,
            'supplier_id' => $request->party,
            'headquarter_id' => $request->headquarter,
            'qty' => $qty,
        ]);

        $sample = Sample::where('product_id', $request->sample)->get();

        if ($sample->count() > 0) {
            $canIssue = true;

            foreach ($sample as $sample) {

                $sampleStock = Sample::where('product_id', $request->sample)
                    ->whereOr('qty', '>', 0)
                    ->groupBy('product_id')
                    ->selectRaw('sum(qty) as total_quantity, product_id')
                    ->first();

                if (!isset($sampleStock) || $sampleStock->total_quantity < $qty) {
                    $canIssue = false;
                    break; // Stop checking other materials if one is not available
                }
            }
        } else {
            $canIssue = false;
        }

        if ($canIssue) {

            $sampleIssue->save();

            // Update the raw material stock
            try {
                foreach ($sample as $sample) {
                    // $actual_qty = $qty * $gift->qty;

                    $sampleStock = Sample::where('product_id', $request->sample)->get();

                    foreach ($sampleStock as $item) {
                        if ($qty > 0)
                            if ($item->qty >= $qty) {
                                $item->qty -= $qty;
                                $qty = 0;
                                $item->save();
                            } else {
                                $qty -= $item->qty;
                                $item->qty = 0;
                                $item->save();
                            }
                    }
                }

                return redirect()->route('sample-challan')->with('success', 'Sample Issue successfully.');
            } catch (\Exception $e) {
                // Handle exceptions here
                return redirect()->back()->with('error', 'Error updating sample stock: ' . $e->getMessage());
            }
        } else {
            $needQuantity = $qty - ($sampleStock->total_quantity ?? 0);
            return redirect()->back()->with([
                'error' => 'Insufficient Sample stock to issue Challan.',
                'needQuantity' => $needQuantity
            ]);
        }
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
