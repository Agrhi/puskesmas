<?php
defined('BASEPATH') or exit('No direct script access allowed');

interface DataInputInterface
{

    public function setFile($path_to_file);

    /**
     * Set attributes
     * 
     * @param array $attributes
     */
    public function setAttributes($attributes = array());

    /**
     * Check if attribute exists
     * 
     * @param  string $attribute
     * @return boolean
     */
    public function hasAttribute($attribute);

    /**
     * Get attribute names
     * 
     * @return array
     */
    public function getAttributes();

    /**
     * Set data
     * 
     * @param array $data
     */
    public function setData($data = array());

    /**
     * Get data
     * 
     * @param  integer $start
     * @param  integer $length
     * @return array
     */
    public function getData($start = 0, $length = null);

    /**
     * Get classes list
     * 
     * @param  array  $attributes List of attribute(s)
     * @return array
     */
    public function getClasses($attributes = array());

    /**
     * Get rows that match the criteria
     * 
     * @param  array   $criteria [{attribute} => {value}]
     * @param  integer $length   Amount of data
     * @return array
     */
    public function getByCriteria($criteria = array(), $length = null);

    /**
     * Count rows that match the criteria
     * 
     * @param  array  $criteria
     * @return integer
     */
    public function countByCriteria($criteria = array());
}
