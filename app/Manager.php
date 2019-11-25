<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{

const ACTIVE_MANAGER = 'Active';
const DISABLED_MANAGER = 'Disabled';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'status',
        'departement_id',
    ];



    function isActive(){
        return $this->status == Manager::ACTIVE_MANAGER;
    }

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
