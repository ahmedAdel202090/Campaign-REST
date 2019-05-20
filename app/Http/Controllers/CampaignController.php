<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CampaignModel;
use App\Services\CampaignService;
use DB;
use Validator;
class CampaignController extends Controller
{
    /**
     * @return JSON 
     *  */
    public function createCampaign(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'country'=>'required',
            'budget'=>'required',
            'goal'=>'required'
        ]);
        if($validator->fails()){
            return json_encode(['status'=>'faild','msg'=>$validator->messages()]);
        }
        CampaignService::createCampaignService($request);
        return json_encode(['status'=>'success','msg'=>'campaign added successfully']);
    }
     /**
     * @return JSON 
     *  */
    public function getDataChart(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'x'=>'required',
            'y'=>'required'
        ]);
        if($validator->fails()){
            return json_encode(['status'=>'faild','msg'=>$validator->messages()]);
        }
        $x=$request->input('x');
        $y=$request->input('y');
        if(!in_array($x,['name','country','budget','goal','category']) || !in_array($y,['name','country','budget','goal','category']))
            return json_encode(['status'=>'faild','msg'=>'there is wrong dimension name in x or y dimension should be on of these "name","country","budget","goal","category"']);
        return json_encode(CampaignService::getOrganizedData($x,$y));
    }
}
