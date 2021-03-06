<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('shortname', 6);
            $table->string('main_server', 20);
            $table->string('ruc', 50);
            $table->string('dgi_auth', 50);
            $table->string('local_currency_code', 10);
            $table->smallInteger('quote_life');
            $table->smallInteger('reservation_life');
            $table->boolean('charge_tip');
            $table->boolean('points_enabled')->default(false);
            $table->boolean('hourly_payment')->default(true);
            $table->double('points_percentage')->default(0);
            $table->float('current_version');
            $table->float('latest_version');
            $table->text('auth_key');
            $table->timestamp('latest_key_change')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->smallInteger('key_change_counter');
            $table->string('base_url', 50);

            $table->foreign('local_currency_code')->references('code')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration');
    }
}
