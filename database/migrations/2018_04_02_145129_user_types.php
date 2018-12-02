<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTypes extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_types', function (Blueprint $table) {
			$table->increments('id');
			$table->string('type', 100);
			$table->integer('created_by');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
		});

		DB::table('user_types')->insert([
				'type' => 'System',
				'created_by' => 1,
				'created_at' => NOW()
			]
		);
		DB::table('user_types')->insert([
				'type' => 'Superadmin',
				'created_by' => 1,
				'created_at' => NOW()
			]
		);
		DB::table('user_types')->insert([
				'type' => 'Admin',
				'created_by' => 1,
				'created_at' => NOW()
			]
		);
		DB::table('user_types')->insert([
				'type' => 'Subscriber',
				'created_by' => 1,
				'created_at' => NOW()
			]
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user_types');
	}
}
