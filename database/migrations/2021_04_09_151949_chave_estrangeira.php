<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChaveEstrangeira extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galerias', function (Blueprint $table) {
            $table->foreignId('capa_id')->nullable()->references('id')->on('galerias_imagens');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('galerias', function (Blueprint $table) {
            $table->dropForeign('galerias_capa_id_foreign');
            $table->dropColumn('capa_id');
        });
    }
}
