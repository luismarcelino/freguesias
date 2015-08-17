use Illuminate\Database\Seeder;

class FreguesiasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the countries table
        DB::table(\Config::get('freguesias.table_name'))->delete();

        //Get all of the countries
        $freguesias = Freguesias::getList();
        foreach ($freguesias as $freguesia){
            DB::table(\Config::get('freguesias.table_name'))->insert(array(
                'id' => $freguesia['id'],
                'parent_id' => $freguesia['parent_id'],
                'type' => ''.$freguesia['type'],
                'name' => ''.$freguesia['name'],
                'short_name' => ''.$freguesia['short_name'],
            ));
        }
    }
}
