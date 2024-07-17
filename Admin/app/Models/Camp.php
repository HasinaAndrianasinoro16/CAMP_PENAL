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
    protected $fillable = ['id','nom','supeficie','province','lattitude','longtitude','sol'];

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
    public static function SaveCamp($nom,$superficie,$province,$lattitude,$longtitude,$sol)
    {
        try {
            $camp = new Camp();
            $camp->id = self::getId();
            $camp->nom = $nom;
            $camp->supeficie = $superficie;
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
    public static function UpdateCamp($id,$nom,$superficie,$province,$lattitude,$longtitude,$sol)
    {
        try {
            $update = DB::table('camp')->where('id', $id)
                ->update([
                    'nom' => $nom,
                    'supeficie' => $superficie,
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
    use HasFactory;
}
