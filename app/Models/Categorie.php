<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    public function skills (){
        return $this->hasMany(Skill::class);
    }

    public function name($lang = null) {
        $lang =$lang?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    public function scopeActive($query){
        return $query->where('active',1);
    }
}
