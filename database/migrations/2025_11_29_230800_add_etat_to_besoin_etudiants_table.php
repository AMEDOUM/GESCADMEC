<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('besoin_etudiants', function (Blueprint $table) {
        $table->string('etat')->default('en attente')->after('description');
    });
}

public function down()
{
    Schema::table('besoin_etudiants', function (Blueprint $table) {
        $table->dropColumn('etat');
    });
}

};
