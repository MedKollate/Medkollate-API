<?php

namespace App\Models;

use App\Filters\ClinicFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clinic extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = ClinicFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
		'clinic_name',
		'address',
		'local_govt',
		'state',
		'reg_number',
		'no_staff',
		'no_dept',
		'logo',
		'payment',
    ];

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(\App\Models\User::class);
	}

}
