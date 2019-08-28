<?php 
require_once('Model.php');

Class CandidatesAddresses extends Model{


	protected $addresses_id;

	protected $candidates_id;


	/* Function insertRelationship
     * Insert a new relationship
     * @return int count of records affected by running the sql statement into relationship.
     */
	function insertRelationship(){
		try {
			$sql = "INSERT INTO `addresses_has_candidates`  (addresses_id, candidates_id) VALUES (:addresses_id, :candidates_id)";
			$params = array(":addresses_id"=>$this->addresses_id,
							":candidates_id"=>$this->candidates_id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteRelationship
     * Delete a relationship
     * @param $id Relationship's id
     * @return int count of records affected by running the sql statement into addresses_has_candidates.
     */
	function deleteRelationship($addresses_id,$candidates_id){
		try {
			$sql = "DELETE FROM `addresses_has_candidates` WHERE addresses_id = :addresses_id AND candidates_id = :candidates_id";
			$params = array(':addresses_id' => $addresses_id,':candidates_id' => $candidates_id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateRelationship
     * Update a relationship
     * @param $params array with Relationship's atributes
     * @return int count of records affected by running the sql statement into addresses_has_candidates.
     */
	function updateRelationship(array $params){
		try {
			$sql = "UPDATE `addresses_has_candidates` SET";
	        $comma = " ";
	        foreach ($params as $key => $value) {
	        	if ($key == "id") {
	        		continue;
	        	}
	            $sql.= $comma.$key." = :".$key;
	            $comma = ", ";
	        }

	        $sql.=" WHERE addresses_id = :addresses_id AND candidates_id = :candidates_id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

}