<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 * 
 * @property int $id
 * @property character varying $name
 * @property character varying $package_name
 * @property character varying $token
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * 
 * @property Collection|Report[] $reports
 *
 * @package App\Models
 */
class Application extends Model
{
	protected $table = 'application';

	protected $casts = [
		'name' => 'character varying',
		'package_name' => 'character varying',
		'token' => 'character varying',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'name',
		'package_name',
		'token'
	];

	public function reports()
	{
		return $this->hasMany(Report::class);
	}
}
