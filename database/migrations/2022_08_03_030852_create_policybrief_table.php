<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicybriefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policybrief', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('desc');
            $table->string('unit');
            $table->string('type');
            $table->string('uploader');
            $table->timestamps();
            $table->string('filepath');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policybrief');
    }
}
