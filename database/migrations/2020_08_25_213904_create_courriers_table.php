<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->string('objet_courrier');
            $table->text('description_courrier')->nullalbe();
            $table->string('url_courrier');
            $table->timestamp('date_depart')->nullable();
            $table->timestamp('date_arrive')->nullable();
            $table->integer('num_depart')->nullable();
            $table->integer('num_arrive')->nullable();
            $table->integer('etat_courrier')->default(0);
            $table->integer('classement_id');
            $table->integer('mention_id');
            $table->integer('typecourrier_id');
            $table->integer('user_id')->nullable();

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
        Schema::dropIfExists('courriers');
    }
}
