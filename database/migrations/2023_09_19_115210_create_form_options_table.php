<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');

            //Set type of filed like text, email, number, select, checkbox, radio, textarea, file, date, time, datetime, password
            $table->string('type')->default('text')->nullable();

            //Set Name and Key for this filed
            $table->json('label')->nullable();
            $table->json('placeholder')->nullable();
            $table->json('hint')->nullable();
            $table->string('name')->index();
            $table->string('group')->nullable();

            //Set Default value for this field
            $table->string('default')->nullable();

            $table->integer('order')->default(0)->nullable();

            //Is Filed Required?
            $table->boolean('is_required')->default(0)->nullable();
            $table->boolean('is_multi')->default(0)->nullable();
            $table->json('required_message')->nullable();

            //Is Field Reactive?
            $table->boolean('is_reactive')->default(0)->nullable();
            $table->string('reactive_field')->nullable();
            $table->string('reactive_where')->nullable();

            //Is Table Select?
            $table->boolean('is_from_table')->default(0)->nullable();
            $table->string('table_name')->nullable();

            //Check if Field is Has options like Select
            $table->boolean('has_options')->default(0)->nullable();
            $table->json('options')->nullable();

            //Valdations
            $table->boolean('has_validation')->default(0)->nullable();
            $table->json('validation')->nullable();

            //For Meta Injection
            $table->json('meta')->nullable();

            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::select('SET foreign_key_checks = 0');
        Schema::hasTable('groups')? \Illuminate\Support\Facades\DB::select('DROP TABLE `groups`') :null;
        Schema::hasTable('form_has_fields')? \Illuminate\Support\Facades\DB::select('DROP TABLE `form_has_fields`') :null;
        Schema::hasTable('field_options')? \Illuminate\Support\Facades\DB::select('DROP TABLE `field_options`') :null;
        Schema::hasTable('fields')? \Illuminate\Support\Facades\DB::select('DROP TABLE `fields`') :null;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_options');
    }
};
