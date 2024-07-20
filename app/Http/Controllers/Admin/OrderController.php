<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wallet;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.create');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.edit', compact('order'));
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('merchant', 'country');

        return view('admin.order.show', compact('order'));
    }
    public function change_status(Order $order)
    {
        $getWallet = Wallet::where('merchant_id','=', $order->merchant_id)
        ->where('country_id','=', $order->country_id)->first();

        $profit = 0;

        foreach (OrderItem::where('order_id', '=', $order->id)->get() as $item) {
            $profit+= ($item->selling_price_for_client - $item->selling_price_for_merchant);
        }



        $order->update(['paid' => 1]);
        $getWallet->update(['balance' => $profit + $getWallet->balance]);


        return redirect()->route('admin.orders.index');
    }
}
