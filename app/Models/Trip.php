<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
	
	public $fillable = ['title','origin','destination','startDatetime','endDatetime','type','description'];
}
