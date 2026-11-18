<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up() runs when we migrate: it creates the posts table.
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();                                   // id (auto-increment primary key)
            $table->string('title');                        // title (VARCHAR 255)
            $table->text('content');                        // content (TEXT)
            $table->string('status', 20)->default('draft'); // status (VARCHAR 20)
            $table->timestamps();                           // created_at and updated_at
        });
    }

    // down() runs when we roll back: it removes the posts table.
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
