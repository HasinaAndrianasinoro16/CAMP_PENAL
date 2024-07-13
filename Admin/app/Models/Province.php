<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table ='province';
    protected $fillable = ['nom'];
    public $timestamps = false;

    public static function getProvince()
    {
        try {
            $province = Province::all();
            return $province;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    use HasFactory;
}
