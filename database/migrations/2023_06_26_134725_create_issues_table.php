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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('complainant_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('investigator_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->text('issue');
            $table->timestamp('date');
            $table->string('area');
            $table->string('type');
            $table->string('severity');
            $table->string('status')->default('Open');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
