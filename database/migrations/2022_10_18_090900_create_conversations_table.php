<?php

/*
 * Fresns (https://fresns.org)
 * Copyright (C) 2021-Present Jevan Tang
 * Released under the Apache-2.0 License.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run fresns migrations.
     */
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('a_user_id');
            $table->unsignedBigInteger('b_user_id');
            $table->unsignedTinyInteger('a_is_display')->default(1);
            $table->unsignedTinyInteger('b_is_display')->default(1);
            $table->unsignedTinyInteger('a_is_pin')->default(0);
            $table->unsignedTinyInteger('b_is_pin')->default(0);
            $table->timestamp('latest_message_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });

        Schema::create('conversation_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('send_user_id');
            $table->timestamp('send_deleted_at')->nullable();
            $table->unsignedTinyInteger('message_type')->default(1);
            $table->text('message_text')->nullable();
            $table->unsignedBigInteger('message_file_id')->nullable();
            $table->unsignedBigInteger('receive_user_id');
            $table->timestamp('receive_read_at')->nullable();
            $table->timestamp('receive_deleted_at')->nullable();
            $table->unsignedTinyInteger('is_enable')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse fresns migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('conversation_messages');
    }
}
