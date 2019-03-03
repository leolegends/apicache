<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RedisTrait;
use Validator;

class RedisController extends Controller
{

    use RedisTrait;
    
    public function generateCache(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
            'method' => 'required'
        ]);

        if($validator->fails()){
            return Response([
                'status' => 401,
                'msg' => 'URL invalida!'
            ], 401);
        }

        $valid = $this->validaURLTrait($request);

        if($valid){

            $cache = $this->generateCacheTrait($valid);

            return [
                'status' => 201,
                'msg' => 'gerado com sucesso',
                'cache_id' => $cache,
                'url' => url("api/cache/{$cache}")
            ];
        }

        return Response([
            'status' => 401,
            'msg' => 'algo deu errado!'
        ], 401);
            
    }

    public function getCache($id)
    {
        return $this->getCacheById($id);
    }
}
