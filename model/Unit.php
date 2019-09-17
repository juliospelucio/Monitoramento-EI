<?php 
require_once('Model.php');

Class Unit extends Model{

	protected $name;

	protected $users_id;

	/* Function getUnits
     * Get all units
     * @return Associate array unit
     */
	function getUnits(){
		try {
			$sql = "SELECT un.id unid, un.name unname, us.name usname, us.email 
					FROM `units` un INNER JOIN `users` us ON un.users_id = us.id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getUnit
     * Get a unit by id
     * @param $id unit in database
     * @return a single row with a Unit
     */
	function getUnit($id){
		try {
			$sql = "SELECT * FROM `units` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertUnit
     * Insert a new unit
     * @return int count of records affected by running the sql statement into units.
     */
	function insertUnit(){
		try {
			$sql = "INSERT INTO `units` (name, users_id) VALUES (:name, :users_id)";
			$params = array(':name' => $this->name,':users_id' => $this->users_id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params,1);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteUnit
     * Delete a unit
     * @param $id unit's id
     * @return int count of records affected by running the sql statement into units.
     */
	function deleteUnit($id){
		try {
			$sql = "DELETE FROM `units` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateUnit
     * Update a unit
     * @param $params array with Unit's atributes
     * @return int count of records affected by running the sql statement into unit.
     */
	function updateUnit(array $params){
		try {
			$sql = "UPDATE `units` SET";
	        $comma = " ";
	        foreach ($params as $key => $value) {
	        	if ($key == "id") {
	        		continue;
	        	}
	            $sql.= $comma.$key." = :".$key;
	            $comma = ", ";
	        }

	        $sql.=" WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getUnit
     * Get a unit by id
     * @param $id unit in database
     * @return a single row with a Unit
     */
	function getUnitEdit($id){
		try {
			$sql = "SELECT un.id unid, un.name unname, us.id usid FROM `units` un INNER JOIN `users` us ON un.users_id = us.id WHERE un.id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
	
}
