<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuppPriceToGarniture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bowl_garnitures', function (Blueprint $table) {
            //
            $table->float('supp_price')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bowl_garnitures', function (Blueprint $table) {
            //
                $table->dropColumn('supp_price');

        });
    }
}
