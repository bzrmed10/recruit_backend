<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{

    const ON ='Activate';
    const OFF ='deactivates';

    protected $fillable = [
        'title',
        'description',
        'salary',    
        'location',
        'status',
        'departement_id',
    ];

    public function isActivate(){
        return $this->status == JobPosition::ON;
    }
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
