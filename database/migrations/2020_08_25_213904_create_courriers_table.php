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
            $table->string('url_courrier');
            $table->timestamp('date_depart')->nullable();
            $table->timestamp('date_arrive')->nullable();
            $table->integer('num_depart');
            $table->integer('num_arrive');
            $table->boolean('etat_courrier')->default(false);
            $table->integer('classement_id');
            $table->integer('mention_id');
            $table->integer('typecourrier_id');
            $table->integer('user_id');

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
