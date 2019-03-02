<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Redis;


trait RedisTrait {

    public function generateCacheTrait($json)
    {

        $uid = uniqid();

        Redis::set($uid, $json);

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

    public function validaURLTrait($url)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"json\"\r\n\r\nhttps://laravel.com/docs/5.7/validation\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache"
        ),
        ));

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