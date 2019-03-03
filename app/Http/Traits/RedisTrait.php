<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


trait RedisTrait {

    public function generateCacheTrait($json)
    {

        $uid = uniqid();

        Redis::set($uid, $json);

        $expiresAt = now()->addHours(2);

        Cache::put($uid, $json, $expiresAt);

        $cache = Redis::get($uid);

        return $uid;

    }

    public function getCacheById($uid)
    {
        $cache = Redis::get($uid);

        if($cache){
            return response()->json(json_decode($cache));
        }

        return [
            'status' => 404,
            'msg' => 'nada encontrado'
        ];
    }

    public function validaURLTrait($request)
    {
        
        $header_req = [];
        
        if(isset($request->header)){
            foreach($request->header as $key => $header){
                $string = $header . ": " . $request->value[$key];
                array_push($header_req, $string); 
            }
        }

        $config = array(
            CURLOPT_URL => $request->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $request->method,
            CURLOPT_HTTPHEADER => $header_req,
        );

        $curl = curl_init();

        curl_setopt_array($curl, $config);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) {
            return false;
        } else {
            $response_valid = \json_decode($response);
            if(is_object($response_valid)){
                 return $response;
             }else{
                 return [
                     'status' => 401,
                     'msg' => 'Essa url não devolve um JSON' 
                 ];
             }
        }
    }

}