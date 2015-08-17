use Illuminate\Database\Migrations\Migration;

class SetupFreguesiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create(\Config::get('freguesias.table_name'), function($table)
		{
		    $table->string('id',6)->index();
		    $table->string('parent_id',6)->nullable();
		    $table->enum('type', ['distrito', 'concelho', 'freguesia']);
		    $table->string('name', 255);
			$table->string('short_name', 255)->nullable();

		    $table->primary('id');
			$table->foreign('parent_id')->references('id')->on(\Config::get('freguesias.table_name'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(\Config::get('freguesias.table_name'));
	}

}
