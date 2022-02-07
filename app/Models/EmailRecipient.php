<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailRecipient
 * 
 * @property character varying $email
 * @property character varying $name
 *
 * @package App\Models
 */
class EmailRecipient extends Model
{
	protected $table = 'email_recipients';
	protected $primaryKey = 'email';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'email' => 'character varying',
		'name' => 'character varying'
	];

	protected $fillable = [
		'name'
	];
}
