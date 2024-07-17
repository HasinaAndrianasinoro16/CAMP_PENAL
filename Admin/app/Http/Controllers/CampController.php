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
            $sol = DB::table('sol')->get();
            return view('Camp')->with('provinces', $province)->with('sols',$sol);
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
                'sol' => 'required',
            ]);
            Camp::SaveCamp(\request('nom'),request('superficie'),request('province'),request('lat'),request('lng'),\request('sol'));
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
    public function UpdateCamp($id)
    {
        try {
            $camp = Camp::getCampById($id);
            $province = DB::table('province')->get();
            $sol = DB::table('sol')->get();
            return view('UpdateMap')->with('provinces',$province)->with('sols',$sol)->with('camps',$camp);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire de modification d'un camp
    public function FormUpdateCamp(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|max:255',
                'superficie' => 'required',
                'province' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'sol' => 'required',
                'id' => 'required',
            ]);
            Camp::UpdateCamp(\request('id'),\request('nom'),\request('superficie'),\request('province'),\request('lat'),\request('lng'),\request('sol'));
            return redirect()->route('Carte');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher les details du camp
    public function DetailCamp($id)
    {
        try {
            $camp = Camp::getCampById($id);
            $culture = DB::table('campculture')->where('camp','=',$id)->get();
            return view('MapDetails')->with('camps',$camp)->with('cultures',$culture);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la page AddCulture
    public function AddCulture()
    {
        try {
            return view('AddCulture');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
