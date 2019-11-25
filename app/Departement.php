<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'name',
        'nbEmployee',
    ];


    public function manager(){
        return $this->hasMany(Manager::class);
    }
    public function jobPosition(){
        return $this->hasMany(jobPosition::class);
    }
}
