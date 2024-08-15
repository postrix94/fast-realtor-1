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
        Schema::create('olx_advertisements', function (Blueprint $table) {
            $table->id();
            $table->tinyText("title")->nullable();
            $table->string("slug", 255)->unique();
            $table->text("body")->nullable();
            $table->tinyText("price")->nullable();
            $table->tinyText("owner_name")->nullable();
            $table->tinyText("information")->nullable();
            $table->tinyText("ad_id")->nullable();
            $table->string("olx", 300);
            $table->string("commentary", 500)->nullable();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olx_advertisements');
    }
};
