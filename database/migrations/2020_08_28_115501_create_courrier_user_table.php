<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourrierUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courrier_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('courrier_id');
            $table->integer('user_id');
           // $table->enum('exp_des',['expediteur', 'destinataire'])->default('expediteur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courrier_user');
    }
}
