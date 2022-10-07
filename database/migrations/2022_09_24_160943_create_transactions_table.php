<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id');

            $table->string('name')->nulllable();
            $table->string('email')->nulllable();
            $table->text('address')->nulllable();
            $table->string('phone')->nulllable();
            $table->string('courier')->nulllable();
            $table->string('payment')->default('MIDTRANS');
            $table->string('payment_url')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->string('status')->default('PENDING');

            $table->softDeletes();


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
        Schema::dropIfExists('transactions');
    }
}
