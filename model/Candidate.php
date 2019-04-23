<?php 
require_once('Model.php');

Class Candidate extends Model{

	protected $name;

	protected $birth_date;

	protected $tel1;

	protected $tel2;

	protected $inscription_date;

	protected $situation;

	protected $units_id;

	protected $parents_id;

	
	/* Function getCandidates
     * Get all candidates
     * @return Associate array candidate
     */
	function getCandidates(){
		try {
			$sql = "SELECT c.id,c.name,c.birth_date,c.tel1,c.tel2,
			c.inscription_date,c.situation,p.mother,p.father 
			FROM `candidates` c INNER JOIN `parents` p ON c.parents_id = p.id ";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getCandidate
     * Get a candidate by id
     * @param $id candidate in database
     * @return a single row with a Candidate
     */
	function getCandidate($id){
		try {
			$sql = "SELECT c.id,c.name,c.birth_date,c.tel1,c.tel2,
			c.inscription_date,c.situation,p.mother,p.father FROM `candidates` c INNER JOIN `parents` p ON c.parents_id = p.id WHERE c.id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertCandidate
     * Insert a new candidate
     * @return int count of records affected by running the sql statement into candidates.
     */
	function insertCandidate(){
		try {
			$sql = "INSERT INTO `candidates` (name, birth_date, tel1, tel2, inscription_date, situation, units_id, parents_id) VALUES (:name, :birth_date, :tel1, :tel2, :inscription_date, :situation, :units_id, :parents_id)";
			$params = array(":name"=>$this->name, ":birth_date"=>$this->birth_date,
			 				":tel1"=>$this->tel1, ":tel2"=>$this->tel2,
			 				":inscription_date"=>$this->inscription_date,
			 				":situation"=>$this->situation, 
			 				":units_id"=>$this->units_id, ":parents_id"=>$this->parents_id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteCandidate
     * Delete a candidate
     * @param $id candidate's id
     * @return int count of records affected by running the sql statement into candidate.
     */
	function deleteCandidate($id){
		try {
			$sql = "DELETE FROM `candidates` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateCandidate
     * Update a candidate
     * @param $params array with Candidate's atributes
     * @return int count of records affected by running the sql statement into candidates.
     */
	function updateCandidate(array $params){
		try {
			$sql = "UPDATE `candidates` SET name =:name, birth_date=:birth_date, tel1=:tel1, tel2=:tel2, inscription_date=:inscription_date, situation=:situation, units_id=:units_id, parents_id=:parents_id WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}