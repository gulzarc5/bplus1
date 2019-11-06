<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VarientValue extends Model
{
    use SoftDeletes;
    protected $table = 'varient_value';

    protected $fillable = [
    	'value','varient','status',
    ];
    protected $primaryKey = 'id';
}
