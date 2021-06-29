<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index(){
        $setting = Settings::first();
        return view('settings.index',compact('setting'));
    }

    public function changeStatus(Request $request)
    {
        $setting = Settings::find($request->setting_id);
        $setting->contactUS = $request->status;
        $setting->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function edit($settingId)
    {
       $setting = Settings::where('settingsID', $settingId)->first();
        return view('settings.edit',compact('setting'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'companyName' => 'required|max:255',
            'email' => 'required|email|max:255',

        ]);

        $setting=Settings::first();
        $setting->companyName=$request->companyName;
        $setting->email=$request->email;
        $setting->point=$request->redeem;
        $setting->free_delivery_on_order_over_tk=$request->free_delivery_on_order_over_tk;
        $setting->address=$request->address;
        $setting->phone=$request->phone;
        $setting->facebook=$request->facebook;
        $setting->twitter=$request->twitter;
        $setting->instagram=$request->instagram;
        $setting->update();

        if($request->hasFile('imageLink')){
            $img = $request->file('imageLink');
            $filename= $setting->settingID.'settingID'.'.'.$img->getClientOriginalExtension();
            $setting->imageLink=$filename;
            $setting->save();
            $location = public_path('settingImage/'.$filename);
            Image::make($img)->save($location);
        }

        return redirect()->route('setting.index');
    }
}
