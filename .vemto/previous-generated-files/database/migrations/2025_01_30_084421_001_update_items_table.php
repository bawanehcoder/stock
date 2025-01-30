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
        Schema::table('items', function (Blueprint $table) {
            $table
                ->bigInteger('maintenance_department_id')
                ->unsigned()
                ->nullable()
                ->after('warehouse_id');
            $table
                ->foreign('maintenance_department_id')
                ->references('id')
                ->on('maintenance_departments')
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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('maintenance_department_id');
            $table->dropForeign('items_maintenance_department_id_foreign');
        });
    }
};
