<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('legal_name');
        $table->boolean('with_vat')->default(false);
        $table->string('inn', 12);
        $table->string('kpp', 9)->nullable();
        $table->string('ogrn', 15);
        $table->string('okpo', 10)->nullable();
        $table->text('legal_address');
        $table->text('actual_address');
        $table->boolean('actual_address_same')->default(false);
        $table->string('bank_name');
        $table->string('account_number', 20);
        $table->string('bik', 9);
        $table->string('correspondent_account', 20)->nullable();
        $table->string('director')->nullable();
        $table->string('phone', 20)->nullable();
        $table->string('manager')->nullable();
        $table->timestamps();
    });
}
}
