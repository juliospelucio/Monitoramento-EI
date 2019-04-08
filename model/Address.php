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
			$sql = "SELECT * FROM `addresses` ";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getAddress
     * Get a address by id
     * @param $id address in database
     * @return a single row with a Address
     */
	function getAddress($id){
		try {
			$sql = "SELECT * FROM `addresses` WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertAddress
     * Insert a new Address
     * @return int count of records affected by running the sql statement into addresses.
     */
	function insertAddress(){
		try {
			$sql = "INSERT INTO `addresses` (address, number, neighborhood) VALUES (:address, :number, :neighborhood)";
			$params = array(':address' => $this->address,
							':number' => $this->number,
							':neighborhood' => $this->neighborhood);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteAddress
     * Delete a address
     * @param $id address's id
     * @return int count of records affected by running the sql statement into address.
     */
	function deleteAddress($id){
		try {
			$sql = "DELETE FROM `addresses` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateAddress
     * Update a address
     * @param $params array with Address's atributes
     * @return int count of records affected by running the sql statement into address.
     */
	function updateAddress(array $params){
		try {
			$sql = "UPDATE `addresses` SET address = :address, number = :number, neighborhood = :neighborhood WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}