<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    protected $table = 'category';

    protected $fillable = [
    	'name','image','status',
    ];
    protected $primaryKey = 'id';
}
