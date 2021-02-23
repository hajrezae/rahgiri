<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMeta;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $page = request('page');
        $total = Tracking::all()->count();

        if($request->search) {
            $trackings = Tracking::where('order_id', 'LIKE', "%{$request->search}%")
            ->orderBy('order_id', 'desc')->paginate(20)->withQueryString();
        }else {
            $trackings = Tracking::orderBy('order_id', 'desc')->paginate(20)->withQueryString();
        }

        $meta = $trackings->all();

        return view('admin.dashboard')->with([
            'page_title' => 'قابتو رهگیری | داشبورد',
            'trackings' => $trackings,
            'meta' => $meta
        ]);
    }
}
