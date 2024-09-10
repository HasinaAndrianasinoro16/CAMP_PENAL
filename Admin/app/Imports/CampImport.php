<?php

namespace App\Imports;

use App\Models\ImportCamp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Liste des colonnes obligatoires (exclut "non_cultivable" car elle peut être vide)
        $requiredFields = ['nom', 'province', 'longitude', 'lattitude', 'sol', 'situation', 'distance', 'region'];

        foreach ($requiredFields as $field) {
            if (!isset($row[$field]) || empty($row[$field])) {
                throw new \Exception('La colonne "' . $field . '" est manquante ou vide.');
            }
        }

        // Conversion des valeurs numériques
        $longitude = str_replace(',', '.', $row['longitude']);
        $latitude = str_replace(',', '.', $row['lattitude']);

        // Gérer les valeurs vides dans la colonne "cultivable"
        $cultivable = isset($row['cultivable']) && !empty($row['cultivable'])
            ? str_replace(',', '.', $row['cultivable'])
            : 0; // Si vide ou manquante, on met "0"

        $nonCultivable = isset($row['non_cultivable']) ? str_replace(',', '.', $row['non_cultivable']) : 0;
        $litige = isset($row['litige']) ? str_replace(',', '.', $row['litige']) : 0;

        return new ImportCamp([
            'nom' => $row['nom'],
            'province' => $row['province'],
            'lattitude' => $latitude,
            'longitude' => $longitude,
            'sol' => $row['sol'],
            'situation' => $row['situation'],
            'distance' => $row['distance'],
            'cultivable' => $cultivable,  // gère les valeurs vides
            'ncultivable' => $nonCultivable,
            'litige' => $litige,
            'region' => $row['region'],
        ]);
    }
}
