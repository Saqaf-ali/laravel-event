<?php

use App\Models\Event;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Ticket::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Event::class)->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);

            //the price of the ticket
            $table->decimal('line_total', 10, 2)->comment('the price of the ticket');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
