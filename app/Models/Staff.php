<?php

namespace App\Models;

use App\Filters\StaffFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Staff extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = StaffFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
		'middle_name',
		'last_name',
		'phone_number',
		'address',
		'email',
		'dept',
		'designation',
		'emergency_contact',
		'emargency_addr',
		'emergency_phone',
		'unique_id',
		'profile_pic',
		'signature',
    ];

	public function generateUserName($name){
		$username = Str::lower(Str::slug($name));
		if(User::where('username', '=', $username)->exists()){
			$uniqueUserName = $username.'-'.Str::lower(Str::random(4));
			$username = $this->generateUserName($uniqueUserName);
		}
		return $username;
	}


}
