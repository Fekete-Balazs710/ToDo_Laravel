<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('priority')->default(1);
            $table->boolean('isChecked')->default(false);
            $table->boolean('isEditing')->default(false);
            $table->date('date')->nullable();
            $table->unsignedBigInteger('user_id'); // Connect to a user
            $table->timestamps();

            // Define foreign key constraint to link the todo to a user
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
