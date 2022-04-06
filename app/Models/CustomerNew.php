<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNew extends Model
{
    use HasFactory;
    protected $table = 'customernews';
    protected $fillable = ['email','password'];

}
