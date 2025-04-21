<?
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class RedisHelper{

    public static function saveInRedis($e){
        $dadosErro = [
            'mensagem' => $e->getMessage(),
            'arquivo' => $e->getFile(),
            'linha' => $e->getLine(),
            'data' => now()->toDateTimeString(),
        ];
    
        Redis::rpush('erros_exceptions', json_encode($dadosErro));
    }
}