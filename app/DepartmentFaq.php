<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentFaq extends Model
{
    protected $fillable=[
        'department_id','question','answer','status',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
