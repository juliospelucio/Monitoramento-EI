<?php 
require_once('Model.php');

Class Classroom extends Model{

	protected $description;

	protected $units_id;

    /* Function getClassrooms
     * Get all classrooms
     * @return Associate array classrooms
     */
	function getClassrooms($id){
		try {
			$sql = "SELECT cl.id, cl.description, cl.units_id, COUNT(ca.id) num FROM `classrooms` cl
					INNER JOIN `candidates` ca ON ca.classrooms_id = cl.id WHERE cl.units_id = :id ORDER BY cl.description";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getClassroom
     * Get a classroom by id
     * @param $id classroom in database
     * @return a single row with a classroom
     */
	function getClassroom($id){
		try {
			$sql = "SELECT * FROM `classrooms` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertClassroom
     * Insert a new classroom
     * @return int count of records affected by running the sql statement into classroom.
     */
	function insertClassroom(){
		try {
			$sql = "INSERT INTO `classrooms` (description, units_id) VALUES (:description, :units_id)";
			$params = array(':description' => $this->description,
							':units_id' => $this->units_id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params,1);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteClassroom
     * Delete a classroom
     * @param $id classroom's id
     * @return int count of records affected by running the sql statement into parents.
     */
	function deleteClassroom($id){
		try {
			$sql = "DELETE FROM `classrooms` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateClassroom
     * Update a classroom
     * @param $params array with Classroom's atributes
     * @return int count of records affected by running the sql statement into classrooms.
     */
	function updateClassroom(array $params){
		try {
			$sql = "UPDATE `classrooms` SET";
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

	/* Function getStudents
     * Get all Students from a certain class
     * @param $id from the classroom
     * @return int count of records affected by running the sql statement into classrooms.
     */
	function getStudents($id){
		try {
			$sql = "SELECT c.id, c.name, c.birth_date, cl.description FROM `classrooms` cl
					INNER JOIN `candidates` c ON cl.id = c.classrooms_id
					WHERE c.classrooms_id = :clid";
			$params = array(':clid' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}