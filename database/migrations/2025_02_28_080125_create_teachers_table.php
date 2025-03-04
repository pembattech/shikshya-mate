<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->string('phone');
            $table->string('address');
            $table->string('position')->default('teacher');
            $table->date('hire_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
