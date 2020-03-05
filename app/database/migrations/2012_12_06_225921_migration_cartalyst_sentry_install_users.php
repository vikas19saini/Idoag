<?php
/**
 * Part of the Sentry package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Sentry
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Database\Migrations\Migration;

class AddMigrationCartalystSentryInstallUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('mobile')->nullable();
			$table->string('gender')->nullable();
			$table->string('faebook_id')->nullable();
			$table->string('google_id')->nullable();
			$table->string('profile_image')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('location')->nullable();
			$table->text('permissions')->nullable();
			$table->boolean('activated')->default(0);
			$table->string('activation_code')->nullable();
			$table->timestamp('activated_at')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('persist_code')->nullable();
			$table->string('reset_password_code')->nullable();
			$table->boolean('import_students')->default(0);
			$table->boolean('manage_categories')->default(0);
			$table->boolean('manage_institutions')->default(0);
			$table->boolean('manage_brands')->default(0);
			$table->boolean('manage_offers')->default(0);
			$table->boolean('brand_users')->default(0);
			$table->boolean('manage_vouchers')->default(0);
			$table->boolean('manage_pincode')->default(0);
			$table->boolean('manage_advertisements')->default(0);
			$table->boolean('manage_testimonials')->default(0);
			$table->timestamps();
			$table->softDeletes();
			
			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->unique('email');
			$table->index('activation_code');
			$table->index('reset_password_code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
