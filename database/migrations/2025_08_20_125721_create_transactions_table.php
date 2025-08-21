<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // ya jo bhi aapke transaction ka data hai
        $table->decimal('amount', 10, 2);
        $table->unsignedBigInteger('user_id'); // ye user se link karega
        $table->timestamps();
        $table->date('date')->nullable();
         $table->string('category_name')->nullable();
        



        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');// Ye foreign key constraint hai jo user_id ko users table ke id se link karega
    });// Ye foreign key constraint hai jo user_id ko users table ke id se link karega
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }// Define the table name if it differs from the pluralized model name
};
