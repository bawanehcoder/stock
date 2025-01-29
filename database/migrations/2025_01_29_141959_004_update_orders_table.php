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
        Schema::table('orders', function (Blueprint $table) {
            $table
                ->bigInteger('supplier_id')
                ->unsigned()
                ->after('id');
            $table
                ->bigInteger('warehouse_id')
                ->unsigned()
                ->after('supplier_id');
            $table->string('name')->after('warehouse_id');
            $table
                ->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreign('warehouse_id')
                ->references('id')
                ->on('warehouses')
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('supplier_id');
            $table->dropColumn('warehouse_id');
            $table->dropColumn('name');
            $table->dropForeign('orders_supplier_id_foreign');
            $table->dropForeign('orders_warehouse_id_foreign');
        });
    }
};
