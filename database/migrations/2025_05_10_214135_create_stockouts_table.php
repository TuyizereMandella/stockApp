<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stockouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->date('stockout_date');
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stockouts');
    }
};