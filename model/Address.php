<?php 
require_once('DBConnection.php');

Class Address{

	private $address;

	private $number;

	private $neighborhood;

	private $dbconfig;

	/* Function __construct
     * Set Atributes to the class
     * @param $name unit's name
     * @param $dbconfig is a db configuration arrays 
     */
	function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
	}

	/* Function setName
     * Set name to the Address
     * @param $attributes array with Address attributes
     */
	function setAttributes(array $attributes){
		foreach ($attributes as $key => $value) {
			$this->$key = $value;
		}
	}

	/* Function __toString
     * Returns a (string) class attributes
     */
	public function __toString(){
        return "address: ". $this->address ."<br>number: " . $this->number ."<br>neighborhood: ".$this->neighborhood;
    }

    /* Function getAddress
     * Get all addresses
     * @return Associate array unit
     */
	function getAddresses(){
		try {
			$sql = "SELECT * FROM `address` ";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

}