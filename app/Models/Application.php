<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 * 
 * @property int $id
 * @property string $name
 * @property string $package_name
 * @property string $token
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
