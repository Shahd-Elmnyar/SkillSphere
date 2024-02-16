<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];
    public function skills (){
        return $this->hasMany(Skill::class);
    }
}
