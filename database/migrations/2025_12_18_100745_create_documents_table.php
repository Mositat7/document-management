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
      Schema::create('documents', function (Blueprint $table) {
    $table->id();

    $table->string('code')->unique(); // شماره شناسنامه خودکار (شمسی)
    $table->string('title');
    $table->enum('type', ['letter', 'document']);
    $table->string('sender');   // فعلا کاربر جاری (string)
    $table->string('receiver');

    $table->text('body')->nullable();
    $table->enum('status', ['draft', 'sent', 'archived'])->default('draft');

    $table->date('registered_at'); // تاریخ شمسی (ذخیره میلادی، نمایش شمسی)

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
