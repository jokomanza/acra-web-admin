<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property character varying $report_id
 * @property int $application_id
 * @property character varying $app_version_code
 * @property character varying $app_version_name
 * @property character varying $package_name
 * @property character varying $file_path
 * @property character varying $phone_model
 * @property character varying $brand
 * @property character varying $product
 * @property character varying $android_version
 * @property string $build
 * @property character varying $total_mem_size
 * @property character varying $available_mem_size
 * @property string $build_config
 * @property string|null $custom_data
 * @property character varying|null $is_silent
 * @property string $stack_trace
 * @property character varying $exception
 * @property string $initial_configuration
 * @property string $crash_configuration
 * @property string $display
 * @property character varying|null $user_comment
 * @property character varying|null $user_email
 * @property character varying $user_app_start_date
 * @property character varying $user_crash_date
 * @property character varying|null $dumpsys_meminfo
 * @property string $logcat
 * @property character varying $installation_id
 * @property string $device_features
 * @property string $environment
 * @property string $shared_preferences
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Application $application
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'report';

	protected $casts = [
		'report_id' => 'character varying',
		'application_id' => 'int',
		'app_version_code' => 'character varying',
		'app_version_name' => 'character varying',
		'package_name' => 'character varying',
		'file_path' => 'character varying',
		'phone_model' => 'character varying',
		'brand' => 'character varying',
		'product' => 'character varying',
		'android_version' => 'character varying',
		'total_mem_size' => 'character varying',
		'available_mem_size' => 'character varying',
		'is_silent' => 'character varying',
		'exception' => 'character varying',
		'user_comment' => 'character varying',
		'user_email' => 'character varying',
		'user_app_start_date' => 'character varying',
		'user_crash_date' => 'character varying',
		'dumpsys_meminfo' => 'character varying',
		'installation_id' => 'character varying'
	];

	protected $fillable = [
		'report_id',
		'application_id',
		'app_version_code',
		'app_version_name',
		'package_name',
		'file_path',
		'phone_model',
		'brand',
		'product',
		'android_version',
		'build',
		'total_mem_size',
		'available_mem_size',
		'build_config',
		'custom_data',
		'is_silent',
		'stack_trace',
		'exception',
		'initial_configuration',
		'crash_configuration',
		'display',
		'user_comment',
		'user_email',
		'user_app_start_date',
		'user_crash_date',
		'dumpsys_meminfo',
		'logcat',
		'installation_id',
		'device_features',
		'environment',
		'shared_preferences'
	];

	public function application()
	{
		return $this->belongsTo(Application::class);
	}
}
