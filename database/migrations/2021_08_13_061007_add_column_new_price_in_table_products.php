<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNewPriceInTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //after - после поля price
            $table->decimal('new_price', $precision = 20, $scale = 2)->after('price')->nullable();
            //after - после поля description
            $table->string('slug')->after('description')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        //для удаления поля при php artisan migrate:rollback
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('new_price');
            $table->dropColumn('slug');

        });
    }
}
