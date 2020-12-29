<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = "user_profile";

    protected $fillable = [
    	'user_id',
    	'firstname',
 		'lastname',
		'country',
		'phone',
		'age',
		'birthday_date',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}