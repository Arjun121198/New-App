<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = ['home'];

    public function setHomeAttribute($value)
    {
     return $this->attributes['name'] = $this->home.' '.$value.' mutator';
    }

}

