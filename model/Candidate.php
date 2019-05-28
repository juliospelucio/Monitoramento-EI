<?php 
require_once('Model.php');

Class Candidate extends Model{

	/*$attributes = array('name'=>$_POST['name'],
						'birth_date'=>$_POST['birth_date'],
						'tel1'=>$_POST['tel1'],
						'tel2'=>$_POST['tel2'],
						'inscription_date'=>$_POST['inscription_date'],
						'neighborhood'=>$_POST['neighborhood'],
						'street'=>$_POST['street'],
						'number'=>$_POST['number'],
						'father'=>$_POST['father'],
						'mother'=>$_POST['mother']);
*/
	protected $name;

	protected $birth_date;

	protected $tel1;

	protected $tel2;

	protected $inscription_date;

	protected $situation;

	protected $units_id;

	protected $address;

	protected $number;

	protected $neighborhood;

	protected $father;
	
	protected $mother;

	
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
			// $sql = "INSERT INTO `candidates` (name, birth_date, tel1, tel2, inscription_date, situation, units_id, parents_id) VALUES (:name, :birth_date, :tel1, :tel2, :inscription_date, :situation, :units_id, :parents_id)";


		$sql = "INSERT INTO parents (father,mother) VALUES (:father,:mother);
		SET @parents_id = LAST_INSERT_ID();

		INSERT IGNORE INTO candidates (name,birth_date,tel1,tel2,inscription_date,situation,units_id,parents_id) VALUES (:name,:birth_date,:tel1,:tel2,:inscription_date,:situation,NULL,@parents_id);
		SET @candidate_id = LAST_INSERT_ID();

		INSERT INTO addresses (address,number,neighborhood) VALUES (:address,:number,:neighborhood);
		SET @address_id = LAST_INSERT_ID();

		INSERT	INTO addresses_has_candidates (addresses_id,candidates_id) VALUES (@address_id,@candidate_id);";
		//MUDAR NO BANCO A COLUNA units_id



			$params = array(":name"=>$this->name,
							":birth_date"=>$this->birth_date,
			 				":tel1"=>$this->tel1,
			 				":tel2"=>$this->tel2,
			 				":inscription_date"=>$this->inscription_date,
			 				":situation"=>$this->situation,
			 				":parents_id"=>$this->parents_id,
			 				":address"=>$this->address,
			 				":number"=>$this->number,
			 				":neighborhood"=>$this->neighborhood,
			 				":father"=>$this->father,
			 				":mother"=>$this->mother
			 				);
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