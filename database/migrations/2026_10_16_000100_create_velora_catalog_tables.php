<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 120)->unique();
            $table->string('title', 180);
            $table->string('location', 180);
            $table->unsignedBigInteger('price');
            $table->string('type', 40)->index();
            $table->unsignedTinyInteger('bedrooms');
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedInteger('area_sq_ft');
            $table->unsignedInteger('land_sq_ft')->nullable();
            $table->string('status', 40)->nullable();
            $table->string('hero_image', 1000);
            $table->json('gallery')->nullable();
            $table->text('description');
            $table->json('features')->nullable();
            $table->string('agent', 160);
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('property_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name', 160);
            $table->string('email', 190)->index();
            $table->string('phone', 40)->nullable();
            $table->string('inquiry_type', 60);
            $table->string('preferred_location', 180)->nullable();
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time', 40)->nullable();
            $table->text('message');
            $table->string('status', 20)->default('new')->index();
            $table->timestamp('consented_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_inquiries');
        Schema::dropIfExists('properties');
    }
};
