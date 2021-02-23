<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    public function create(Request $request)
    {
        $carriers = Carrier::all();
        return view('admin.carrier.carrier-create')->with([
            'carriers' => $carriers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ],
            [
                'name.required' => 'وارد کردن نام پیک الزامیست'
            ]);

//        if ($request->file('image')->isValid()) {
//            $image = $request->file('image');
//            $name = time() . '-' . $image->getClientOriginalName();
//            $image->storeAs('public/images', $name);
//        }


        Carrier::updateOrCreate([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => ''
        ]);

        $carriers = Carrier::all();

        return redirect()->route('carrier-create')->with([
            'success', 'پیک با موفقیت اضافه شد',
            'carriers' => $carriers
        ]);


    }

    public function edit(Carrier $carrier)
    {
        return view('admin.carrier.carrier-edit')->with('carrier', $carrier);
    }

    public function update(Carrier $carrier, Request $request)
    {
        $carrier->update($request->only(['name', 'description']));

        return redirect()->route('carrier-edit', $carrier);
    }

    public function delete(Carrier $carrier) {
        try{
            $carrier->delete();
        }catch(\Exception $e) {
            dd($e);
        }
        return redirect()->route('carrier-create');
    }



}
