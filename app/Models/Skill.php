<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    public function categorie (){
        return $this->belongsTo(Categorie::class);
    }
    public function exams (){
        return $this->hasMany(Exam::class);
    }
}
