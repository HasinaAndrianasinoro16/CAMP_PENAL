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
            $abouts = DB::table('about_camp')->where('id_camp','=',$id)->get();
            return view('MapDetails')->with('camps',$camp)->with('cultures',$culture)->with('abouts',$abouts);
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

    //controller pour afficher la page d'ajout d'information
    public function AddInfo()
    {
        try {
            $region = DB::table('region')->get();
            $situation = DB::table('situation')->get();
            return view('Addinfo')->with('regions',$region)->with('situations',$situation);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher le formulaire d'ajout de Situation juridique
    public function Situation()
    {
        try {
            return view('Situation');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //form action des situations judiciaire
    public function SaveSituation(Request $request)
    {
        try {
            $request->validate([
                'situation' => 'required|string',
            ],[
                'situation.required' => 'Situation obligatoire',
                'situation.string' => 'le champ Situation judiciaire doit etre une chaine de caractere',
            ]);
            Camp::SaveSituation($request->situation);
            return redirect()->back()->with('success2','Situation judiciaire enregistrer avec succes');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $exception->getMessage()]);
        }
    }

    //controller pour le formualire de sauvegarde des informations supplementaire du camp
    public function SaveInfo(Request $request)
    {
        try {
            $request->validate([
                'camp' => 'required',
                'distance' => 'required|string',
                'litige' => 'nullable|numeric',
                'cultivable' => 'required|numeric',
                'ncultivable' => 'required|numeric',
                'region' => 'required',
                'situation' => 'required',
            ],[
                'camp.required' => 'Camp obligatoire',
                'distance.required' => 'Distance obligatoire',
                'distance.string' => 'Distance doit être une chaîne de caractères',
                'litige.numeric' => 'Litige doit être un nombre réel ou décimal',
                'cultivable.required' => 'Surface cultivable obligatoire',
                'cultivable.numeric' => 'Surface cultivable doit être un nombre réel ou décimal',
                'ncultivable.required' => 'Surface non cultivable obligatoire',
                'ncultivable.numeric' => 'Surface non cultivable doit être un nombre réel ou décimal',
                'region.required' => 'Localité obligatoire',
                'situation.required' => 'Situation obligatoire',
            ]);

            Camp::SaveMore($request->camp, $request->situation, $request->distance, $request->cultivable, $request->ncultivable, $request->litige, $request->region);

            return redirect()->back()->with('success', 'Info enregistrée avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $exception->getMessage()]);
        }
    }

    //la page d'exportation en pdf
//    public function Recensement($id)
//    {
//        try {
////            $camp = Camp::getCampById($id);
////            $culture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
//            $abouts = DB::table('about_camp')->where('id_camp','=',$id)->get();
//            return view('Recensement')->with('abouts',$abouts);
////            return view('Recensement')->with('camps',$camp)->with('cultures',$culture)->with('abouts',$abouts);
//        }catch (\Exception $exception){
//            throw new \Exception($exception->getMessage());
//        }
//    }


//    public function Dons(Request $request)
//    {
//        try {
//            // Validation des données avec messages d'erreur personnalisés
//            $request->validate([
//                'id' => 'required|string',
//                'materiel' => 'required|string',
//                'colab' => 'required|string',
//                'qte' => 'required|numeric',
//                'date' => 'required|date',
//            ], [
//                'id.required' => 'Le champ ID est obligatoire.',
//                'id.integer' => 'L\'ID doit être une chaine de carctere.',
//                'materiel.required' => 'Le champ Matériel est obligatoire.',
//                'materiel.string' => 'Le champ Matériel doit être une chaîne de caractères.',
//                'colab.required' => 'Le champ Collaborateur est obligatoire.',
//                'colab.string' => 'Le champ Collaborateur doit être une chaîne de caractères.',
//                'qte.required' => 'Le champ Quantité est obligatoire.',
//                'qte.numeric' => 'Le champ Quantité doit être un nombre.',
//                'date.required' => 'Le champ Date est obligatoire.',
//                'date.date' => 'Le champ Date doit être une date valide.',
//            ]);
//
//            // Appel à la méthode Dons
//            Camp::Dons($request->input('id'), $request->input('materiel'), $request->input('colab'), $request->input('qte'), $request->input('date'));
//
//            // Redirection avec un message de succès
//            return redirect()->back()->with('success2', 'Don enregistré avec succès');
//
//        } catch (\Exception $exception) {
//            // Gestion des erreurs avec un message utilisateur
//            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $exception->getMessage()]);
//        }
//    }
}
