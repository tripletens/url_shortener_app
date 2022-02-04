<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\URL;

class UrlController extends Controller
{
    //
    public function create_url(Request $request){

        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $original_url = $request->input('url');
        
        $code = Str::random(6);

        $new_url = env('APP_URL') . $code;

        // return $new_url;
        
        // $new
        $create_short_url = URL::Create([
            'code' => $code, 
            'original_url' => $original_url, 
            'new_url' => $new_url
        ]);
        
        if(!$create_short_url){
            $data = [
                'error' => $url,
                'original_url' => $original_url
            ];

            return back()->with($data);
        }

        $data = [
            'success' => 'You have successfully created a short URL',
            'original_url' => $original_url,
            'new_url' => $new_url
        ];

        return back()->with($data);
    }

    public function view_site($code){
        $check_code = URL::where('code',$code)->first();

        // check if the code is valid i.e exists on our database 
        if($check_code){
            $original_url = $check_code->original_url;

            return redirect($original_url);
        }
    }
}
