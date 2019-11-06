<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    protected $table = 'color';

    protected $fillable = [
    	'name','value','category','first_category','second_category','status',
    ];
    protected $primaryKey = 'id';
}
