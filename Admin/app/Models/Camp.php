<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Camp extends Model
{
    protected $table = 'camp';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id','nom','province','lattitude','longtitude','sol'];

    //fonction pour la creation d'un identifiant
    public static function getId()
    {
        try {
            $seqvalue = DB::select("SELECT nextval('seqcamp')");
            if (!empty($seqvalue)) {
                $seqvalue = $seqvalue[0]->nextval;
            } else {
                throw new QueryException("jereo tsara le anarana sequence na verifeo ko hoe misy sequence tokoa v, ao ligne 20 ny olana");
            }

            return "CAMP00" . $seqvalue;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour creer un nouveau camp
    public static function SaveCamp($nom,$province,$lattitude,$longtitude,$sol)
    {
        try {
            $camp = new Camp();
            $camp->id = self::getId();
            $camp->nom = $nom;
            $camp->province = $province;
            $camp->lattitude = $lattitude;
            $camp->longitude = $longtitude;
            $camp->sol = $sol;
            $camp->save();

            return $camp;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour l'update
    public static function UpdateCamp($id,$nom,$province,$lattitude,$longtitude,$sol)
    {
        try {
            $update = DB::table('camp')->where('id', $id)
                ->update([
                    'nom' => $nom,
                    'province' => $province,
                    'lattitude' => $lattitude,
                    'longitude' => $longtitude,
                    'sol' => $sol,
                ]);
            return $update;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour recuperer un camp par son id
    public static function getCampById($id)
    {
        try {
            $camp = DB::table('v_camp')->where('id','=', $id)->first();
            return $camp;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour inserer une nouvelle culture dans un camp
    public static function SaveCampCulture($camp, $culture, $superficie)
    {
        try {
            $save = DB::table('campculture')
                ->insert([
                    'camp' => $camp,
                    'culture' => $culture,
                    'superficie' => $superficie,
                ]);
            return $save;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer les info suplementaire
    public static function SaveMore($camp, $situation, $distance, $cultivable, $ncultivable, $litige, $region)
    {
        try {
            $insert = DB::table('more')
                ->insert([
                   'camp' => $camp,
                   'situation' => $situation,
                   'distance' => $distance,
                   'cultivable' => $cultivable,
                   'ncultivable' => $ncultivable,
                   'litige' => $litige,
                    'region' => $region,
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public static function SaveSituation($situation)
    {
        try {
            $insert = DB::table('situation')
                ->insert([
                    'nom' => $situation,
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    use HasFactory;
}
