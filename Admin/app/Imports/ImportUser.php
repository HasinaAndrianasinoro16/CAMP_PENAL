<?php

namespace App\Imports;

use App\Models\Province;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUser implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//         dd($row);

        // Vérifiez les colonnes importantes et arrêtez l'exécution si une colonne obligatoire est manquante ou vide
        if (empty($row['nom']) || empty($row['email']) || empty($row['password']) || empty($row['imatricule']) || empty($row['province'])) {
            throw new \Exception("Une des colonnes obligatoires est manquante ou vide.");
        }

        $usertype = ($row['poste'] == 'DRAP' || $row['poste'] == 'D.R.A.P') ? 1 : 2;

        $province = DB::table('province')
            ->where('nom', '=', $row['province'])
            ->value('id');

        if (!$province) {
            throw new \Exception("La province " . $row['province'] . " est introuvable.");
        }

        return new Users([
            'name' => $row['nom'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'imatricule' => $row['imatricule'],
            'usertype' => $usertype,
            'province' => $province,
        ]);
    }



}
