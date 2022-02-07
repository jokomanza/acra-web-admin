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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
		'token' => 'character varying'
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
