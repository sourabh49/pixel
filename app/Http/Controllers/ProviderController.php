<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
class ProviderController extends Controller
{
    //
    function signup(Request $request)
    {
            $provider= new Provider;
            $name=$request->name;
            if(!$name)
            {
                return ['message'=>"Please enter provider name"];
            }
            
            $provider->provider_name=$name;
            
            $result=$provider->save();
            if($result)
            {
                return ['message'=>"submitted"];
            }
            else
            {
                return ['result'=>"error"];
            }
    }
    function providerList()
    {
            $data = Provider::all();
            if($data)
            {
                $response['message'] ='Provider list.';		           	  
                $response['status'] = 1;
                $response['data'] = $data;
            }
            else
            {
                $response['message'] ='Error';		           	  
                $response['status'] = 0;
                $response['data'] = $data;
            }
            return $response;
    }
    // function providerListView()
    // {
    //         $data = Provider::all();
    //         return view('providerList',['provider'=>$data]);
            
    // }
}
