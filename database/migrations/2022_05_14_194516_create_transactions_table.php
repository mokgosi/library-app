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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->integer('book_id');
            $table->integer('member_id');
            $table->timestamp('date_issued')->useCurrent();
            $table->date('date_due');
            $table->date('date_returned')->nullable();
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->string('penalty')->default('0.00');
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
};
