<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CUserTypes extends Model
{
	const SYSTEM		= 1;
	const SUPER_ADMIN	= 2;
	const ADMIN			= 3;
	
	protected $table = 'user_types';
}
