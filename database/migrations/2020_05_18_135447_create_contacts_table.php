<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable(false)
                ->comment('User id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('patronymic_name')->nullable();
            $table->string('phone');
            $table->boolean('is_favorite')->nullable()->default(null);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->index(['last_name', 'first_name'],'last_name_first_name_IDX');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
