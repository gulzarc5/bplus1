<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varient extends Model
{
    use SoftDeletes;
    protected $table = 'varient';

    protected $fillable = [
    	'name','category','first_category','second_category','status',
    ];
    protected $primaryKey = 'id';
}
