<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    // public $incrementing = false;
    protected $table = 'contact';
    protected $fillable=[
        'created_at',
        'updated_at',
        'deleted_at',
        'cle',
        'e_mail',
        'nom',
        'prenom',
        'telephone_fixe',
        'service',
        'fonction'
    ];
    public function  organisation() {
        return $this->belongsTo(Organisation::class,'organisation_id');
    }
}
