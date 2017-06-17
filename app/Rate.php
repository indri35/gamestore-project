<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $table = 't_rate';
    public $fillable = ['id','id_user','id_game','user_name','email', 'comment', 'updated_at','created_at'];
    public $primaryKey = 'id';
    public $incrementing = true; 

}