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
		    $table->integer('parent_id')->unsigned()->nullable();
		    $table->enum('type', ['distrito', 'concelho', 'freguesia']);
		    $table->string('name', 255);
			$table->string('short_name', 255)->nullable();

		    $table->primary('id');
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
