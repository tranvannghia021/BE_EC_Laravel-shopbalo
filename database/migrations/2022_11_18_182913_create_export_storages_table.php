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
        Schema::create('export_storages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("export_amount");
            $table->foreignId("product_id")->constrained("products");
            $table->foreignId("provider_id")->constrained("providers");
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
        Schema::dropIfExists('export_storages');
    }
};
