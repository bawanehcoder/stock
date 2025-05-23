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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('warehouse_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table
                ->bigInteger('user_id')
                ->unsigned()
                ->index()
                ->after('status');
            $table
                ->bigInteger('warehouse_id')
                ->unsigned()
                ->index()
                ->after('user_id');
        });
    }
};
