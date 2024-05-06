<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    //
    public function receipt():View
    {
   $id=session()->get('id');
   $order=Order::find($id);

   $orderDetail=Order_detail::where('order_id',$id)->get();
    return view('penjualan.receipt')->with([
        'dataOrder'=>$order,
        'dataOrderDetail'=>$orderDetail
    ]);
}
}
