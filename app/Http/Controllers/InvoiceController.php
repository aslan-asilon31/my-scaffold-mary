<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;

class InvoiceController extends Controller
{

    public function index()
    {

        $customer = SalesOrder::with('customer') 
        ->latest() 
        ->first();


        $order = SalesOrderDetail::with('product')->where('sales_order_id',$customer->id) // Memuat relasi customer
        ->latest() 
        ->first();


        // dd( $order);
        $title = 'INVOICE';
    
        return view('invoice', compact('title', 'customer','order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
