<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\Order;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TrackingController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.tracking.list');
    }

    public function create(Request $request)
    {
        $carriers = Carrier::all();
        return view('admin.tracking.create')->with([
            'page_title' => 'قابتو | اطلاعات ارسال',
            'carriers' => $carriers
            ])->with(['pill' => 'pills-postcode']);;
    }

    public function storePostCodes(Request $request)
    {
        $request->validate(
            [
                'postcodes' => ['required'],
                'ship_date_datetime' => ['required', 'date']
            ],
            [
                'postcodes.required' => 'وارد کردن اطلاعات پستی الزامیست',
                'ship_date_datetime.required' => 'تاریخ الزامی است'
            ]
        );

        $codes = json_decode($request->input('postcodes'));
        $ship_date = $request->input('ship_date_datetime');
        $carrier_id = 1;
        $created_ids = [];
        $not_exists_orders = [];

        foreach ($codes as $code) {
            $order_exists = Order::find($code->order_id);
            if (!$order_exists) {
                array_push($not_exists_orders, $code->order_id);
                continue;
            }

            $tracking = Tracking::updateOrCreate([
                'order_id' => $code->order_id,
                'carrier_id' => $carrier_id,
            ],
                [
                    'order_id' => $code->order_id,
                    'carrier_id' => $carrier_id,
                    'ship_date' => $ship_date,
                    'tracking_code' => $code->tracking_code,
                    'tracking_note' => 'تحویل شده به اداره پست',
                    'status' => 'delivering'
                ]);

            array_push($created_ids, $tracking->order_id);
        }
        $success = count(array_diff($created_ids, $not_exists_orders));
        return redirect()->route('tracking-create')->with([
            'success'=> "اطلاعات {$success} سفارش با موفقیت در دیتابیس ذخیره شد.",
            'not_exists' => join(",", $not_exists_orders),
        ]);

    }

    public function storeMotorCodes(Request $request){
        session()->flash('pill', 'pills-motor');

        $data = $request->validate([
            'motorcodes' => ['required'],
            'carrier' => ['required']
        ],[
            'motorcodes.required' => 'وارد کردن شناسه های سفارش الزامی است',
            'carrier.required' => 'پیک الزامی است'
        ]);

        $codes = json_decode($request->formatted_motorcodes);
        $carrier = $request->carrier;
        $ship_date = $request->motorcode_ship_time;

        $success = [];
        $failed = [];
        foreach($codes as $order_id) {

            if(!! Order::find($order_id)) {
                $tracking = Tracking::updateOrCreate([
                    'order_id' => $order_id,
                ],
                    [
                        'order_id' => $order_id,
                        'carrier_id' => $carrier,
                        'ship_date' => $ship_date,
                        'tracking_code' => 'ارسال شده توسط پیک و فاقد کد پیگیری',
                        'tracking_note' => 'تحویل شده به پیک و در حال پخش'
                    ]);

                array_push($success, $order_id);
            }else {
                array_push($failed, $order_id);
            }

        }

        return redirect()->route('tracking-create')->with(['success' => join(',', $success), 'failed' => join(',', $failed), 'pill'=> 'pills-motor']);

    }

    public function storeTipax(Request $request)
    {
        session()->flash('pill', 'pills-tipax');
        $request->validate([
            'carrier_id' => 'required'
        ],
        [
           'carrier_id.required' => 'شیوه حمل و نقل الزامی است'
        ]);


        $data = $request->all();
        $trackings = $data['tracking'];
        $carrier = $request->get('carrier_id');
        $found = [];
        $not_found = [];
        foreach($trackings as $tracking) {
            if(Order::where('id', $tracking['order_id'])->where('post_type', 'shop_order')->first()) {
                $order_id = $tracking['order_id'];
                $tracking = Tracking::updateOrCreate([
                    'order_id' => $order_id,
                ],
                    [
                        'order_id' => $order_id,
                        'carrier_id' => $carrier,
                        'ship_date' => now(),
                        'tracking_code' => $tracking['tracking_code'],
                        'tracking_note' => 'تحویل شده به دفتر تیپاکس و در حال پخش'
                    ]);

                array_push($found, $order_id);
            }else {
                array_push($not_found, $tracking['order_id']);
            }
        }

        return redirect()->route('tracking-create')->with(['pill'=>'pills-tipax', 'not_found' => join(',', $not_found),'found' => join(',', $found)]);
    }

    public function edit(Tracking $tracking)
    {

        return view('admin.tracking.edit', compact('tracking'));
    }

}
