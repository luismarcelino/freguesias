<?php

namespace Luismarcelino\Freguesias;

use Illuminate\Database\Eloquent\Model;

/**
 * Freguesias
 *
 */
class Freguesias {

	/**
	 * @var string
	 * Array containing freguesias data.
	 */
	protected $freguesias;

	/**
	 * @var string
	 * The table for the freguesias in the database, is "freguesias" by default.
	 */
	protected $table;

    /**
     * Get the countries from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getFreguesias()
    {
        //Get the freguesias from the CSV file
        if (sizeof($this->freguesias) == 0){
			if (($handle = fopen(__DIR__ . '/freguesias.csv', 'r')) !== FALSE) {
			    while (($data = fgetcsv($handle)) !== FALSE) {
			        if (count($data)>1){
						$distritoId = $data[0];
						if (!is_numeric($distritoId)){
							continue;
						}
						if (!isset($this->freguesias[$distritoId])){
							$this->freguesias[$distritoId]=[
								'id' => $distritoId,
								'name' => $data[1],
								'short_name' => $data[1],
								'type' => 'distrito',
								'parent_id' => null,
							];
						}
						$concelhoId = $distritoId.$data[2];
						if (!isset($this->freguesias[$concelhoId])){
							$this->freguesias[$concelhoId]=[
								'id' => $concelhoId,
								'name' => $data[3],
								'short_name' => $data[3],
								'type' => 'concelho',
								'parent_id' => $distritoId,
							];
						}
						$freguesiaId = $concelhoId.$data[4];
						if (!isset($this->freguesias[$freguesiaId])){
							$this->freguesias[$freguesiaId]=[
								'id' => $freguesiaId,
								'name' => $data[6],
								'short_name' => $data[5],
								'type' => 'freguesia',
								'parent_id' => $concelhoId,
							];
						}
					}
			    }
			    fclose($handle);
			}
        }

        //Return the countries
        return $this->freguesias;
    }

	/**
	 * Returns one country
	 *
	 * @param string $id The freguesia id
     *
	 * @return array
	 */
	public function getOne($id)
	{
        $freguesias = $this->getFreguesias();
		return $freguesias[$id];
	}

	/**
	 * Returns a list of countries
	 *
	 * @param string sort
	 *
	 * @return array
	 */
	public function getList($sort = null)
	{
	    //Get the countries list
	    $freguesias = $this->getFreguesias();

	    //Sorting
	    $validSorts = array(
	        'id',
	        'name',
        );

	    if (!is_null($sort) && in_array($sort, $validSorts)){
	        uasort($freguesias, function($a, $b) use ($sort) {
	            if (!isset($a[$sort]) && !isset($b[$sort])){
	                return 0;
	            } elseif (!isset($a[$sort])){
	                return -1;
	            } elseif (!isset($b[$sort])){
	                return 1;
	            } else {
	                return strcasecmp($a[$sort], $b[$sort]);
	            }
	        });
	    }

	    //Return the countries
		return $freguesias;
	}
}
