<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id'); //per aggiungere la colonna type_id e posizionarla dopo l'id di projacts

            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null'); //per dirgli che type_id è l'id della tabella types
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign'); //facciamo l'inversione togliendo la relazione
            $table->dropColumn('type_id'); //e qua togliendo la colonna
        });
    }
};
