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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('person_name')->nullable();
            $table->string('person_type')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('hair')->nullable();
            $table->string('eye')->nullable();
            $table->string('ethnicity')->nullable();
            $table->text('statement')->nullable();
            $table->string('identification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
