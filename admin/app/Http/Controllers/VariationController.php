<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function index()
    {
      $variationData = Variation::get()->groupBy('variationType');
      return view('variation.index',compact('variationData'));   
    }

    public function variationSubmit(Request $data)
    {
        $this->validate($data, [
            'selectionType' => 'required',
        ]);

        if ($data->variationValue && count($data->variationValue)>0){
            foreach ($data->variationValue as $variationValue){
                $variation = new Variation();
                $variation->variationType = $data->type;
                $variation->selectionType = $data->selectionType;
                $variation->variationValue = $variationValue;
                $variation->save();
            }
        }
        Variation::where('variationType',$data->type)->update(['selectionType' => $data->selectionType]);
        return response()->json([
            'message' => "Variation saved successfully."
        ]);
    }

    public function addVariation()
    {
        return view('variation.variationForm');
    }

    public function variationValue(Request $variationData)
    {
        if (isset($variationData->value)){
            return Variation::where('variationType',$variationData->value)->get();
        }else{
            return Variation::select('variationType')->get()->groupBy('variationType');
        }
    }

    public function editVariationData(Request $variationData)
    {
        $data = Variation::where('variationType',$variationData->type)->get();
        return view('variation.variationForm',compact('data'));
    }
}
