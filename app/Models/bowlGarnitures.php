<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bowlGarnitures extends Model
{
    use HasFactory;
    protected $fillable=['name','supp_price'];
}
