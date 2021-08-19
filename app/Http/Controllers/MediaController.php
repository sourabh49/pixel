<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use Illuminate\Support\Facades\DB;


class MediaController extends Controller
{
    //
    function upload(Request $request)
    {
            $media= new Media;
            $media_name=$request->media_name;
            $provider_id=$request->provider_id;
            $type=$request->type;
            $check_file=$request->file('file');
            if(!$check_file)
            {
                return ['message'=>"Please Upload File"];
            }
            $size = $request->file("file")->getSize();           
            if(empty($size)||$size>2000000)
            {
                return ['message'=>"Please Upload file less than 2Mb"];
            }
            $file=$request->file('file')->store('apiFile');    //storing file to folder       
            if(!$media_name)
            {
                return ['message'=>"Please enter media name"];
            }
            if(!$provider_id)
            {
                return ['message'=>"Please Select Provider"];
            }
            
            
            $extension = $request->file('file')->extension();
            
            if(!($extension=="jpg"||$extension=="jpeg" ||$extension=="mp3" ||$extension=="mp4"))
            {
                return ['message'=>"Please Upload jpg or jpeg or mp3 file or mp4"];
                
            }

            $media->provider_id=$provider_id;
            $media->name=$media_name;
            $media->type=$type;
            $media->media=$file;
            $result=$media->save();
            if($result)
            {
                $response['message'] ='Submitted Successfully';		           	  
                $response['status'] = 1;
                $response['data'] = $media;
            }
            else
            {
                $response['message'] ='Error';		           	  
                $response['status'] = 0;
                $response['data'] = $result;
            }
            return $response;

    }
    
    function mediaList(Request $request)
    {
            $provider_id=$request->provider_id;

            $data= DB::table('media')
            ->where("provider_id",$provider_id)
            ->get();
            
            if(count($data))
            {
                $response['message'] ='Media list.';		           	  
                $response['status'] = 1;
                $response['data'] = $data;
            }
            else
            {
                $response['message'] ='No Media';		           	  
                $response['status'] = 0;
                $response['data'] = $data;
            }
            return $response;
    }   
    // function mediaListView(Request $request)
    // {
    //         $provider_id=$request->provider_id;

    //         $data= DB::table('media')
    //         ->where("provider_id",$provider_id)
    //         ->get();
            
    //         return view('mediaList');
    // }   
   
}
