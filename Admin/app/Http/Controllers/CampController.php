<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampController extends Controller
{
    //conrtoller pour afficherf la page camp penal
    public function Camp()
    {
        try {
            $province = DB::table('province')->get();
            return view('Camp')->with('provinces', $province);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la page carte
    public function Carte()
    {
        try {
            return view('Map');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
