<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('api_users', function (Blueprint $table) {
            $table->id();

            $table->string('identifier', 30);
            $table->string('key', 60);

            $table->rememberToken();
            $table->timestamp('created_at')->default(Carbon::now(config('app.timezone')));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('api_users');
    }
};
