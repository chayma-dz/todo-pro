<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('category')->nullable();
        $table->string('priority')->default('faible');
        $table->date('due_date')->nullable();
        $table->text('description')->nullable();
        $table->string('status')->default('en cours');
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
