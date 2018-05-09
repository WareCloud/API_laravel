<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBundleDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_datas', function (Blueprint $table) {
            $table->unsignedInteger('bundle_id');
            $table->unsignedInteger('software_id');
            $table->unsignedInteger('configuration_id')->nullable();

            $table->foreign('bundle_id')->references('id')->on('bundles')->onDelete('cascade');;
            $table->foreign('software_id')->references('id')->on('softwares');
            $table->foreign('configuration_id')->references('id')->on('configurations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_datas');
    }
}
