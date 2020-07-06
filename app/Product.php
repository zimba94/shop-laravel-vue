<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     //
     protected $fillable =[
        'id','name','slug','price','description','status'
    ];
}
