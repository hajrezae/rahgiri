<?php

namespace App\Http\Controllers;

use App\Classes\Jalali;
use App\Models\Order;
use App\Models\OrderMeta;
use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
class CustomerTrackingController extends Controller
{
    public function index()
    {
        return view('front.customer-search');
    }

    public function find(Request $request)
    {

        $order = Order::where('ID', $request->orderId)->first();
        if($order && $order->post_type == 'shop_order') {
            $tracking = $order->tracking;
            $meta = $order->ordermeta->pluck('meta_value', 'meta_key');

            if(!$tracking) {
                return ['order' => $order, 'meta' => $meta];
            }

            $carrier = $tracking->carrier;
            $meta['_completed_date'] = Jalali::jdate("l j F ساعت G:i" ,strtotime($meta['_completed_date']),'' ,'local');

            return ['order' => $order, 'tracking' => $tracking, 'meta' => $meta, 'carrier' => $carrier];
        }else {
            return 'order-not-found';
        }
    }
}
