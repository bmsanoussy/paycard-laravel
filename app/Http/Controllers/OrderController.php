<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}