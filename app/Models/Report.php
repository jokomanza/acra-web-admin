<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property string $report_id
 * @property int $application_id
 * @property string $app_version_code
 * @property string $app_version_name
 * @property string $package_name
 * @property string $file_path
 * @property string $phone_model
 * @property string $brand
 * @property string $product
 * @property string $android_version
 * @property array $build
 * @property string $total_mem_size
 * @property string $available_mem_size
 * @property array $build_config
 * @property array|null $custom_data
 * @property string|null $is_silent
 * @property string $stack_trace
 * @property string $exception
 * @property array $initial_configuration
 * @property array $crash_configuration
 * @property array $display
 * @property string|null $user_comment
 * @property string|null $user_email
 * @property string $user_app_start_date
 * @property string $user_crash_date
 * @property string|null $dumpsys_meminfo
 * @property string $logcat
 * @property string $installation_id
 * @property array $device_features
 * @property array $environment
 * @property array $shared_preferences
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
		'application_id' => 'int',
		'build' => 'json',
		'build_config' => 'json',
		'custom_data' => 'json',
		'initial_configuration' => 'json',
		'crash_configuration' => 'json',
		'display' => 'json',
		'device_features' => 'json',
		'environment' => 'json',
		'shared_preferences' => 'json'
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
