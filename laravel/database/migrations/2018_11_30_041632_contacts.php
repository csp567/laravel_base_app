<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contacts extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 100);
			$table->string('middle_name', 100)->nullable();
			$table->string('last_name', 100);
			$table->string('primary_number', 20);
			$table->string('secondary_number', 20)->nullable();
			$table->string('email', 200);
			$table->string('contact_image', 500)->nullable();
			$table->integer('created_by');
			$table->timestamps();
			$table->softDeletes();
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
