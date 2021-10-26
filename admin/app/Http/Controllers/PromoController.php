<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PromoController extends Controller
{
    public function index(){
        return view('promo.index');
      }

      public function list(){
          $promo = Promo::all();
          return datatables()->of($promo)
              ->make(true);
      }
      public function create()
      {
          return view('promo.add');
      }

      public function edit($id)
      {
          $promo = Promo::findOrfail($id);
          return view('promo.edit',compact('promo'));
      }


        public function store(Request $r){
            $this->validate($r, [
                'promo_code' => 'required',
                'start_date' => 'required|date_format:Y-m-d H:i:s|after:today|before:end_date',
                'end_date' => 'required|date_format:Y-m-d H:i:s|after:start_date',
                'discount' => 'required',
                'status' => 'required',
            ]);
            if (isset($r->promo_id) && !empty($r->promo_id)){
                $promo = Promo::find($r->promo_id);
            }else{
                $promo = new Promo();
            }
            $promo->promo_code = preg_replace('/\s/', '', $r->promo_code);
            $promo->start_date = date('Y-m-d h:i:s', strtotime($r->start_date));
            $promo->end_date = date('Y-m-d h:i:s', strtotime($r->end_date));
            $promo->discount=$r->discount;
            $promo->status = $r->status;
            $promo->save();

            return redirect()->route('promo');
        }
}
