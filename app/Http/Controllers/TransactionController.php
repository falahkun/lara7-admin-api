<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use App\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('pages.transactions.index')->with([
            'id' => 0,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.transactions.create')->with([
            'products' => $products,
            'count' => 1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array_of_product_id = $request->product_id;
        $result = [];
        $no = 0;

        $mytime = Carbon::now();

        $data = [
            'order_subtotal' => $request->amount,
            'order_self_pickup' => !empty($request->isSelfPickup) ? $request->isSelfPickup : "0",
            'order_scheduled' => !empty($request->isScheduled) ? $request->isScheduled : "0",
            'order_scheduled_date' => !empty($request->isScheduled) ? $request->scheduled_date . " " . $request->scheduled_time : "",
            'order_created' => $mytime->format('Y-m-d H:i:s'),
            'order_status' => '0'

        ];

        $jsonDate = $mytime->toArray();

        $data['invoice'] = "ORD" . mt_rand(100000, 999999) . $jsonDate['year'] . $jsonDate['month'] . $jsonDate['day'];

        $transaction = Transaction::create($data);


        foreach ($array_of_product_id as $id) {
            // $result[$no++] = explode('-',$id)[0];
            $transactionDetail = TransactionDetail::create([
                'product_id' => explode('-', $id)[0],
                'transaction_id' => $transaction->id,
                // 'quantity' => $request->all()['min_order'][$no]
            ]);

            Product::find(explode('-', $id)[0])->decrement('quantity', $request->all()['min_order'][$no++]);
        }

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Transaction::findOrFail($id);
        return view('pages.transactions.update')->with([
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
