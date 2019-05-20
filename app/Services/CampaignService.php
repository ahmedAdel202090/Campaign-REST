<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\CampaignModel;
use DB;

class CampaignService
{
    /**
     * @return void
     *  */
    public static function createCampaignService(Request $request)
    {
        $campaign=new CampaignModel();
        $campaign->name=$request->input('name');
        $campaign->country=$request->input('country');
        $campaign->budget=$request->input('budget');
        $campaign->goal=$request->input('goal');
        if($request->has('category')){
            $campaign->category=$request->input('category');
        }
        else {
             
             $campaign->category=CampaignService::getDummyCategory();
        }
        $campaign->save();
    }
    /**
     * @return string
     *  */
    public static function getDummyCategory()
    {
            $result=json_decode(file_get_contents("https://ngkc0vhbrl.execute-api.eu-west-1.amazonaws.com/api/?url=https://arabic.cnn.com/"),true);
            $category=$result["category"];
            return $category["name"];
    }
    /**
     * @return array
     *  */
    public static function getOrganizedData($x,$y)
    {
        $campaigns=CampaignModel::select(DB::raw('count(*) as density,'.$x.','.$y))->
        groupBy($x,$y)->get();
        return ['status'=>'success','campaigns'=>$campaigns,'dimensions'=>[$x,$y]];
    }
}