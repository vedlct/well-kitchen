<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\PromoImage;
use App\Models\PromoProduct;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PromotionController extends Controller
{
    public function index(){
        return view('promotion.index');
      }
   
      public function list(){
          $promotion=Promotion::with('promoImage');
          return datatables()->of($promotion)
              ->addColumn('image', function ($promotion) {
                  if(!empty($promotion->promoImage)){
                      $url= asset('public/promoImage/'. $promotion->promoImage->imageLink);
                      return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                  }else{
                      return 'No image';
                  }
               })
              ->rawColumns(['image'])
              ->make(true);
      }
      public function create()
      {
          return view('promotion.add');
      }
   
      public function edit($id)
      {
          $promotion=Promotion::findOrfail($id);
          $promoImage = PromoImage::where('fkpromotionsId',$id)->first();
          if(!empty($promoImage)){
              data_set($promotion, 'imageLink', $promoImage->imageLink);
          }
          return view('promotion.edit',compact('promotion'));
      }
   
      
        public function store(Request $r){
            $this->validate($r, [
                'promotionTitle' => 'required|max:10',
                'imageLink' => 'image|required_if:promotionsId,null',
                'promotionCode' => 'required',
                'startDate' => 'required|date_format:Y-m-d H:i:s|after:today|before:endDate',
                'endDate' => 'required|date_format:Y-m-d H:i:s|after:startDate',
                'type' => 'required',
                'percentValue' => 'required_if:type,%|numeric|nullable',
                'amount' => 'required|numeric',
                'limit' => 'required|numeric',
                'status' => 'required',
            ]);
            if (isset($r->promotionsId) && !empty($r->promotionsId)){
                $promotion = Promotion::find($r->promotionsId);
            }else{
                $promotion = new Promotion();
            }
            $promotion->promotionstitle = $r->promotionTitle;
            $promotion->promotionCode = preg_replace('/\s/', '', $r->promotionCode);
            $promotion->startDate = date('Y-m-d h:i:s', strtotime($r->startDate));
            $promotion->endDate = date('Y-m-d h:i:s', strtotime($r->endDate));
            $promotion->amount=$r->amount;
            if($r->type == '%'){
                $promotion->percentage=$r->percentValue;
            }elseif($r->type == 'TK'){
                $promotion->percentage = null;
            }
            $promotion->status = $r->status;
            $promotion->useLimit = $r->limit;
            $promotion->save();
            if($r->hasFile('imageLink')){
                if (isset($r->promotionsId) && !empty($r->promotionsId)){
                    $promoImage = PromoImage::where('fkpromotionsId',$r->promotionsId)->first();
                }else{
                    $promoImage = new PromoImage();
                }
                $img = $r->file('imageLink');
                $filename=date('dhs').rand(10,10000) . '.'.$img->getClientOriginalExtension();
                $promoImage->imageLink=$filename;
                $location = public_path('promoImage/'.$filename);
                Image::make($img)->save($location);
                $promoImage->fkpromotionsId=$promotion->promotionsId;
                $promoImage->save();
            }
            return redirect()->route('promotion');
        }



       
   
       public function promoProduct($id){
           return view('promotion.promoProduct')->with('promoid',$id);
       }
   
       public function promoProductInsert(Request $r){
          $length = count($r->value);
          if($length > 0 ){
           for ($i = 0; $i < $length; $i++) {
               $promoProduct=new PromoProduct();
               $promoProduct->fkpromotionsId=$r->id;
               $promoProduct->fkproductId=$r->value[$i];
               $promoProduct->save();
           }
        }
        return response()->json('success',200);
        //    return response()->json(['success'=>'Got Simple Ajax Request.']);
      }
   
   
      public function showProduct($id){
          $promoProduct=PromoProduct::with('product')->where('fkpromotionsId',$id)->get();
        //  dd($promoProduct);
        // return response()->json(['success'=> $promoProduct]);
          return view('promotion.showProduct',compact('promoProduct'));
   
      }
}
