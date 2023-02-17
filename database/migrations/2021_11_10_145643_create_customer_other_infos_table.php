<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOtherInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_other_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("customer_id")->comment("Müsteri si");
            $table->tinyInteger("you_found_us")->nullable()->comment("1-website 2-sosyal medya:facebook,instagram 3-ziyaret 4-telefon görüşmesi");
            $table->text("description")->nullable()->comment("Kısa açıklama");
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
        Schema::dropIfExists('customer_other_infos');
    }
}
