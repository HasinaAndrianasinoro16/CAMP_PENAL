<?php

namespace App\Http\Controllers;

use App\Models\Camp;
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
            $camp = DB::table('v_camp')->get();
            return view('Map')->with('camps', $camp);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'ajout de camp penal
    public function form_camp_penal(Request $request){
        try {
            $request->validate([
                'nom' => 'required|max:255',
                'superficie' => 'required',
                'province' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);
            Camp::SaveCamp(\request('nom'),request('superficie'),request('province'),request('lat'),request('lng'));
            return redirect()->route('Carte');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
//controller pour supprimer un camp
    public function DeleteCamp($id)
    {
        try {
            DB::table('camp')->where('id', $id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la page de modification d'un camp
}
