<?php

use App\Enums\IdentityType;
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
        Schema::create('identity_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('type', IdentityType::getValues());
            $table->string('number');
            $table->date('issued_at')->nullable();
            $table->string('issued_by')->nullable();

            $table->string('front_image_path')->nullable();
            $table->string('back_image_path')->nullable();
            $table->string('selfie_image_path')->nullable();
            $table->unique(['type', 'number']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identify_documents');
    }
};
