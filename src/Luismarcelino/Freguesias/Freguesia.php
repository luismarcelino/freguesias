<?php

namespace Luismarcelino\Freguesias;

use Illuminate\Database\Eloquent\Model;

/**
 * CountryList
 *
 */
class Freguesia extends Model {

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
       $this->table = \Config::get('freguesias.table_name');
    }

    /**
     * @return bool
     */
    public function isFreguesia() {
        return $this->type == 'freguesia';
    }

    /**
     * @return bool
     */
    public function isConcelho() {
        return $this->type == 'concelho';
    }

    /**
     * @return bool
     */
    public function isDistrito() {
        return $this->type == 'distrito';
    }

    public function parentAdmistrative() {
        return $this->belongsTo('Luismarcelino\Freguesias\Freguesia', 'parent_id');
    }

    public function childAdmistratives()
    {
        return $this->hasMany('Luismarcelino\Freguesias\Freguesia', 'parent_id');
    }

    static public function getDistritos() {
        return Freguesia::whereNull('parent_id');
    }

    static public function getConcelhos($distritoId) {
        return Freguesia::whereNull('parent_id');
    }

}
