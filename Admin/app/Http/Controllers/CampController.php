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
                'province' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'sol' => 'required',
            ]);
            Camp::SaveCamp(\request('nom'),request('province'),request('lat'),request('lng'),\request('sol'));
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
                'province' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'sol' => 'required',
                'id' => 'required',
            ]);
            Camp::UpdateCamp(\request('id'),\request('nom'),\request('province'),\request('lat'),\request('lng'),\request('sol'));
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
            $culture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            return view('MapDetails')->with('camps',$camp)->with('cultures',$culture);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la page AddCulture
    public function AddCulture($id)
    {
        try {
            $culture = DB::table('culture')->get();
            $campculture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            $sol = Camp::getCampById($id);
            $sol_id = $sol->id_sol;
            $suggest = DB::table('v_culture')->where('id_sol','=',$sol_id)->get();
            return view('AddCulture')->with('cultures',$culture)->with('campcultures', $campculture)->with('sugs',$suggest)->with('sol',$sol);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'insertion d'une culture pour un camp
    public function FormAddCulture(Request $request)
    {
        try {
            $request->validate([
                'camp' => 'required',
                'culture' => 'required',
                'superficie' => 'required',
            ]);
            Camp::SaveCampCulture(\request('camp'),\request('culture'),\request('superficie'));
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

}
