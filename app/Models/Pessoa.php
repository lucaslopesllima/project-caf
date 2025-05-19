<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'id',
        'nome',
        'idade',
        'quantidade_filhos',
        'naturalidade',
        'bairro',
        'escolaridade',
        'cpf',
        'is_volunteer'
    ];

    public static function getEachPeopleRegisteredPerMonth(){
        return self::selectRaw('MONTH(created_at) AS month, COUNT(*) AS count')
                    ->whereRaw('YEAR(created_at) = YEAR(NOW())')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->toArray();
    }


    public static function getLastRegisteredPeople(){
        return self::orderBy('id','desc')->limit(5)->get();
    }
   
}
