<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    // public $incrementing = false;
    protected $table = 'organisation';
    protected $fillable=[
        'created_at',
        'updated_at',
        'deleted_at',
        'cle',
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'statut'
    ];
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
