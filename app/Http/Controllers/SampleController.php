<?php

namespace App\Http\Controllers;

use App\Models\Headquarters;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sample;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = Sample::groupBy('product_id')
            ->selectRaw('sum(qty) as total_quantity, product_id')
            ->get();

        // $samples = Sample::all();
        return view('admin.sample.sample', compact('master'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::whereStatus(true)->get();
        $headquarters = Headquarters::whereStatus(true)->get();
        return view('admin.sample.sample-create', compact('products', 'headquarters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'headquarter_id' => 'required',
            'qty' => 'required'
        ]);

        $qty = $request->qty ?? 0;

        $products = ProductStock::where('product_id', $request->product_id)->get();

        if ($products->count() > 0) {
            $canCreate = true;
            foreach ($products as $product) {

                $productStock = ProductStock::where('product_id', $request->product_id)
                    ->where('expiry_date', '>', \Carbon\Carbon::now())
                    ->whereOr('quantity', '>', 0)
                    ->groupBy('product_id')
                    ->selectRaw('sum(quantity) as total_quantity , product_id')
                    ->first();

                if (!isset($productStock) || $productStock->total_quantity < $qty) {
                    $canCreate = false;
                    break;
                }
            }
        } else {
            $canCreate = false;
        }

        if ($canCreate) {

            Sample::create($request->post());

            try {

                foreach ($products as $product) {
                    $productStocks = ProductStock::where('product_id', $request->product_id)
                        ->where('expiry_date', '>', \Carbon\Carbon::now())
                        ->orderBy('expiry_date')
                        ->get();

                    foreach ($productStocks as $item) {
                        if ($qty > 0) {
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
                return redirect()->route('sample.index')->with('success', 'Stocks Assigned Successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error updating Product stock: ' . $e->getMessage());
            }
        } else {
            $needQuantity =  $qty - ($productStock->total_quantity ?? 0);
            return redirect()->back()->with([
                'error' => 'Insufficient stock to Assign Sample.',
                'needQuantity' => $needQuantity
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */

    public function sample_detail_id($product_id)
    {

        // Fetch entries with matching raw_material_id
        $sample = Sample::where('product_id', $product_id)->get();

        return view('admin.sample.sample-detail', compact('sample'));
    }

    public function show(Sample $sample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sample $sample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        //
    }
}
