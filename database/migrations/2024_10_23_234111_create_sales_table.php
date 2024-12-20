<?php

use App\Models\User;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignIdFor(User::class);
            $table->decimal('total',8,2);
            $table->enum('payment_method', ['cash', 'card', 'mobile']);
            $table->decimal('sub_total',8,2);
            $table->decimal('vat',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
