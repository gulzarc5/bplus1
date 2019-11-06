<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeValue extends Model
{
	 use SoftDeletes;
	 protected $table = 'size_value';

    protected $fillable = [
    	'value','size','status',
    ];
    protected $primaryKey = 'id';
}
