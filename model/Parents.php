<?php 
require_once('Model.php');

Class Parents extends Model{

	protected $mother;

	protected $father;

    /* Function getParents
     * Get all addresses
     * @return Associate array parents
     */
	function getParents(){
		try {
			$sql = "SELECT * FROM `parents` ";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getParents
     * Get a parents by id
     * @param $id parents in database
     * @return a single row with a parents
     */
	function getParent($id){
		try {
			$sql = "SELECT * FROM `parents` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertParents
     * Insert a new Parents
     * @return int count of records affected by running the sql statement into parents.
     */
	function insertParent(){
		try {
			$sql = "INSERT INTO `parents` (mother, father) VALUES (:mother, :father)";
			$params = array(':mother' => $this->mother,
							':father' => $this->father);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params,1);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteParent
     * Delete a parent
     * @param $id parent's id
     * @return int count of records affected by running the sql statement into parents.
     */
	function deleteParent($id){
		try {
			$sql = "DELETE FROM `parents` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateParent
     * Update a parent
     * @param $params array with Parent's atributes
     * @return int count of records affected by running the sql statement into parents.
     */
	function updateParent(array $params){
		try {
			$sql = "UPDATE `parents` SET";
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
}