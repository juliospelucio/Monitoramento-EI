<?php 
require_once('Model.php');

Class Address extends Model{

	protected $street;

	protected $number;

	protected $neighborhood;


    /* Function getAddress
     * Get all addresses
     * @return Associate array address
     */
	function getAddresses(){

		$class_vars = get_class_vars(static::class);
		$vars = "";
		foreach ($class_vars as $name => $value) {
		    $vars .= "$name : $value"."<br>";
		}
        print_r($vars);

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
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
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
			$sql = "INSERT INTO `addresses` (street, number, neighborhood) VALUES (:street, :number, :neighborhood)";
			$params = array(':street' => $this->street,
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
			$sql = "UPDATE `addresses` SET street = :street, number = :number, neighborhood = :neighborhood WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}