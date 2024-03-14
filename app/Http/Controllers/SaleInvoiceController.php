<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SaleInvoice;
use App\Models\Suppliers;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = SaleInvoice::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new SaleInvoice())->getTable());
        $allSuppliersColumns = Schema::getColumnListing((new Suppliers())->getTable());

        $sales = SaleInvoice::with('party')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allSuppliersColumns) {
                $query->where(function ($query) use ($keyword, $allColumns, $allSuppliersColumns) {
                    // Dynamically construct the search query for SaleInvoice
                    foreach ($allColumns as $column) {
                        $query->orWhere($column, 'LIKE', "%$keyword%");
                    }

                    // Dynamically construct the search query for Product

                    // Dynamically construct the search query for Suppliers
                    foreach ($allSuppliersColumns as $column) {
                        $query->orWhereHas('party', function ($query) use ($keyword, $column) {
                            $query->where($column, 'LIKE', "%$keyword%");
                        });
                    }
                });
            })
            ->latest()
            ->paginate($rows);

        return view('admin.sale-invoice.sale-invoice', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $party = Suppliers::whereStatus(true)->get();

        $date = date("Y-m-d");
        $products = Product::select('products.*','units.short_name',DB::raw('SUM(product_stocks.quantity) As tquantity'))->join('product_stocks','product_stocks.product_id', '=', 'products.id')->join('units','units.id','=','products.unit_id')->where('products.status',1)->where('product_stocks.expiry_date', '>', $date)->groupBy('product_stocks.product_id')->get();


        return view('admin.sale-invoice.create', compact('party', 'products'));
    }
    public function print($id)
    {

        $sale = SaleInvoice::select('sale_invoices.*', 'sale_products.rates', 'sale_products.total', 'sale_products.qtys', 'suppliers.name as supplier', 'products.name as productname', 'units.short_name')->join('sale_products', 'sale_products.invoice_id', '=', 'sale_invoices.product_id')->join('suppliers', 'suppliers.id', '=', 'sale_invoices.supplier_id')->join('products', 'products.id', '=', 'sale_products.products')->join('units', 'units.id', '=', 'products.unit_id')->where('sale_invoices.id', $id)->get();
        return view('admin.sale-invoice.pdf', compact('sale'));
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
            'supplier_id' => 'required',
            'place' => 'required',
            'due_date' => 'required',
            'type' => 'required',
        ]);

        foreach($request->product_id  as $key => $value) {
        $qty = $request->qty[$key];
        $date = date("Y-m-d");

         $checkStock = Product::select('products.name',DB::raw('SUM(product_stocks.quantity) As tquantity'))->join('product_stocks','product_stocks.product_id', '=', 'products.id')->where('product_stocks.product_id', $value)->where('product_stocks.expiry_date', '>', $date)->groupBy('product_stocks.product_id')->first();

         $tquantity = $checkStock->tquantity;
         $pname = $checkStock->name;
          if ($qty > $tquantity) {
            return redirect()->back()->with('error', 'Only  ' . $tquantity . ' '.$pname.' Is In Stock! You need '.($qty - $tquantity).' More');
            die;
          }
    }
    $invoice_id = random_int(100000, 99999999);
    $total_amnt = 0;
    foreach($request->product_id  as $key => $value) {
        $total_amnt += $request->qty[$key]*$request->rate[$key];
        $qtty = $request->qty[$key];
        $cqty = $request->qty[$key];

            $proc = new SaleProduct;
            $proc->products = $value;
            $proc->qtys = $request->qty[$key];
            $proc->rates = $request->rate[$key];
            $proc->total = $request->qty[$key]*$request->rate[$key];
            $proc->invoice_id = $invoice_id;
            $proc->save();

$checkStock = ProductStock::select('*')->where('product_id', $value)->where('expiry_date', '>', $date)->orderBy('expiry_date', 'ASC')->get();
foreach ($checkStock as $item) {
                if ($cqty > 0) {
                    if ($item->quantity >= $qty) {
                        $item->quantity -= $qty;
                        $qty = 0;
                        ProductStock::where('id', $item->id)->update(['quantity' => $item->quantity]);
                    } else {
                        $qty -= $item->quantity;
                        $item->quantity = 0;
                        ProductStock::where('id', $item->id)->update(['quantity' => 0]);
                    }
                } else {
                    break;
                }
            }

    }

            $sale = new SaleInvoice;
            $sale->supplier_id = $request->supplier_id;
            $sale->place = $request->place;
            $sale->product_id = $invoice_id;
            $sale->due_date = $request->due_date;
            $sale->type = $request->type;
            $sale->total_amt = $total_amnt;
            $sale->save();


            return redirect()->route('sale.index')->with('success', 'Data saved successfully !!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleInvoice $saleInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleInvoice $saleInvoice)
    {
        //
    }
}
