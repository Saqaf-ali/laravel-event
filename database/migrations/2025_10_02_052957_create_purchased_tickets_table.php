<?php

use App\Models\Attendee;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchased_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Ticket::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Attendee::class)->constrained()->onDelete('cascade');
            $table->string('ticket_code')->unique();
            $table->boolean('is_used')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_tickets');
    }
};
