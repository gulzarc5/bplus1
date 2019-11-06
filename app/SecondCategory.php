<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecondCategory extends Model
{
	use SoftDeletes;
   protected $table = 'second_category';

    protected $fillable = [
    	'name','category_id','first_category_id','image','status',
    ];
    protected $primaryKey = 'id';

    public function Category()
    {
    	return $this->hasOne('App\Category','id','category_id');
    }
    public function firstCategory()
    {
    	return $this->hasOne('App\FirstCategory','id','first_category_id');
    }
}
