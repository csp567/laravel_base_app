<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedContacts extends Model
{
	use SoftDeletes;
	protected $table = 'shared_contacts';
	protected $fillable = [ 'contact_id', 'shared_by', 'shared_with', 'referance_id' ];

}
