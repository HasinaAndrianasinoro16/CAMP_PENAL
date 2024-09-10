<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportCamp extends Model
{
    protected $table = 'importcamp';
    protected $fillable = ['nom','province','lattitude','longitude','sol','situation','distance','cultivable','ncultivable','litige','region'];
    public $timestamps = false;
    use HasFactory;
}
