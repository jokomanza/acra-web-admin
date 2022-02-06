<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('report_id');
            $table->bigInteger('application_id')->unsigned();
            $table->string('app_version_code');
            $table->string('app_version_name');
            $table->string('package_name');
            $table->string('file_path');
            $table->string('phone_model');
            $table->string('brand');
            $table->string('product');
            $table->string('android_version');
            $table->json('build');
            $table->string('total_mem_size');
            $table->string('available_mem_size');
            $table->json('build_config');
            $table->json('custom_data')->nullable();
            $table->string('is_silent')->nullable();
            $table->longText('stack_trace');
            $table->string('exception');
            $table->json('initial_configuration');
            $table->json('crash_configuration');
            $table->json('display');
            $table->string('user_comment')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_app_start_date');
            $table->string('user_crash_date');
            $table->string('dumpsys_meminfo')->nullable();
            $table->longText('logcat');
            $table->string('installation_id');
            $table->json('device_features');
            $table->json('environment');
            $table->json('shared_preferences');
            $table->timestamps();

            $table->foreign('application_id')
                ->references('id')
                ->on('application');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
