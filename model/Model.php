<?php 
require_once('DBConnection.php');

abstract Class Model{

	protected $dbconfig;

	/* Function __construct
     * Set Atributes to the class
     * @param $name unit's name
     * @param $dbconfig is a db configuration arrays 
     */
	function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
	}

	/* Function setAttributes
     * Set the atributes to the object
     * @param $attributes array with class attributes
     */
	function setAttributes(array $attributes){
		foreach ($attributes as $key => $value) {
			$this->$key = $value;
		}
	}
	//--------------------------------VERIFICAR----------------------------
	/* Function __toString
     * Returns a (string) class attributes
     */
	function __toString(){

		$class_vars = get_class_vars(static::class);
		$vars = "";
		foreach ($class_vars as $name => $value) {
		    $vars .= "$name : $value"."<br>";
		}
        return $vars;
    }
}