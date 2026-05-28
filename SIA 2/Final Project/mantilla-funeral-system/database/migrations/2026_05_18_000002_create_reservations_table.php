<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('funeral_service_id')->constrained('funeral_services')->restrictOnDelete();

            $table->string('deceased_name', 150);
            $table->unsignedTinyInteger('deceased_age')->nullable();
            $table->date('date_of_death')->nullable();
            $table->date('preferred_schedule');

            $table->string('contact_person', 150);
            $table->string('contact_number', 30);
            $table->text('notes')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'preferred_schedule']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
