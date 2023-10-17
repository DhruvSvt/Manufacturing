<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\GiftIssue;
use App\Models\Headquarters;
use App\Models\ItemStock;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {

        $gifts = Gift::whereStatus(true)->get();
        $party = Suppliers::whereStatus(true)->get();
        $hq_name = Headquarters::whereStatus(true)->get();

        $issues = GiftIssue::latest()->get();
        return view('admin.challans.gift', compact('party', 'hq_name', 'gifts', 'issues'));
    }

    public function store(Request $request)
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
}
