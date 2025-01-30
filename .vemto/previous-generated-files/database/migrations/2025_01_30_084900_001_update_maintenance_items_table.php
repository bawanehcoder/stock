<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_items', function (Blueprint $table) {
            $table
                ->bigInteger('asset_id')
                ->unsigned()
                ->after('damaged_id');
            $table
                ->foreign('asset_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_items', function (Blueprint $table) {
            $table->dropColumn('asset_id');
            $table->dropForeign('maintenance_items_asset_id_foreign');
        });
    }
};
