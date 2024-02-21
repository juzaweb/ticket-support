<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'jwts_ticket_support_comments',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('content');
                $table->json('attachments')->nullable();
                $table->foreignUuid('ticket_support_id')->index()->constrained('jwts_ticket_supports');
                $table->foreignId('created_by')
                    ->index()
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('set null');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jwts_ticket_support_comments');
    }
};
