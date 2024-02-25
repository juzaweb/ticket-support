<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(
            'jwts_ticket_supports',
            function (Blueprint $table) {
                $table->dropColumn('attachments');
            }
        );

        Schema::create(
            'jwts_ticket_support_attachments',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignUuid('ticket_support_id')->constrained('jwts_ticket_supports');
                $table->string('path');
                $table->string('name');
                $table->string('extension');
                $table->string('minetype');
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
        Schema::dropIfExists('jwts_ticket_support_attachments');
        Schema::table(
            'jwts_ticket_supports',
            function (Blueprint $table) {
                $table->json('attachments')->nullable();
            }
        );
    }
};
