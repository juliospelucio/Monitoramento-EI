<?php 
require_once('Model.php');
require_once('Address.php');
require_once('Parents.php');
require_once('CandidatesAddresses.php');

Class Candidate extends Model{

	protected $name;

	protected $birth_date;

	protected $tel1;

	protected $tel2;

	protected $inscription_date;

	protected $situation;

	protected $units_id;

	protected $obs;

	protected $conf_date;

	protected $address;

	protected $parents;


	/* Function __construct
     * Set Atributes to the class
     * @param $dbconfig is a db configuration arrays 
     */
	public function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
		$this->address = new Address($dbconfig);
		$this->parents = new Parents($dbconfig);
		$this->CandidateAddress = new CandidatesAddresses($dbconfig);
	}

	/* Function getCandidates
     * Get all candidates
     * @return Associate array candidate
     */
	public function getCandidates(){
		try {
			$sql = "SELECT c.id,c.name,c.birth_date,c.tel1,c.tel2,c.inscription_date,c.situation,p.mother,p.father 
					FROM `candidates` c 
					INNER JOIN `parents` p ON c.parents_id = p.id ORDER BY c.inscription_date" ;
					
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
	public function getCandidate($id){
		try {
			$dbc = new DBConnection($this->dbconfig);
			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation, c.obs, c.conf_date,
						   a.id aid, a.street, a.number, a.neighborhood, p.id pid, p.mother, p.father, u.id uid, u.name uname
					FROM candidates c 
					INNER JOIN addresses_has_candidates h ON h.candidates_id = c.id
					INNER JOIN addresses a ON a.id = h.addresses_id
					INNER JOIN parents p ON p.id = c.parents_id
					INNER JOIN units u ON u.id = c.units_id
					WHERE c.id = :id";

			$params = array(':id' => $id);
			$query = $dbc->getQuery($sql,$params);
			if ($query) {
				return $query;
			}

			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation, c.obs, c.conf_date,
						   a.id aid, a.street, a.number, a.neighborhood, p.id pid, p.mother, p.father
					FROM candidates c 
					INNER JOIN addresses_has_candidates h ON h.candidates_id = c.id
					INNER JOIN addresses a ON a.id = h.addresses_id
					INNER JOIN parents p ON p.id = c.parents_id
					WHERE c.id = :id";
			$params = array(':id' => $id);

			return $dbc->getQuery($sql,$params);

		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getCategory
     * Get a candidates between start date and end date
     * @param $stDate 
     * @param $endDate candidate in database
     * @return array with candidates
     */
	public function getCategory($stDate,$endDate){

		try {
			$dbc = new DBConnection($this->dbconfig);
			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation, c.obs, c.conf_date,
						   a.id aid, a.street, a.number, a.neighborhood, p.id pid, p.mother, p.father
					FROM candidates c 
					INNER JOIN addresses_has_candidates h ON h.candidates_id = c.id
					INNER JOIN addresses a ON a.id = h.addresses_id
					INNER JOIN parents p ON p.id = c.parents_id
					WHERE c.birth_date BETWEEN :stDate AND :endDate ORDER BY c.inscription_date";
			
			$params = array(':stDate' => $stDate, ':endDate' => $endDate);

			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getInscriptions
     * Get a candidates between start date and end date
     * @param $stDate 
     * @param $endDate candidate in database
     * @return array with candidates
     */
	public function getInscriptions($stDate,$endDate){

		try {
			$dbc = new DBConnection($this->dbconfig);
			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation, c.obs, c.conf_date,
						   a.id aid, a.street, a.number, a.neighborhood, p.id pid, p.mother, p.father
					FROM candidates c 
					INNER JOIN addresses_has_candidates h ON h.candidates_id = c.id
					INNER JOIN addresses a ON a.id = h.addresses_id
					INNER JOIN parents p ON p.id = c.parents_id
					WHERE c.inscription_date BETWEEN :stDate AND :endDate ORDER BY c.inscription_date";
			
			$params = array(':stDate' => $stDate, ':endDate' => $endDate);

			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function countCandidates
     * Get the number of candidates sent to units on current year
     * @param $stDate starting date
     * @param $endDate end date
     * @param $units_id current unit id
     * @return int with total candidates
     */
	public function countCandidates($stDate,$endDate,$units_id){

		try {
			$dbc = new DBConnection($this->dbconfig);
			$sql = "SELECT COUNT(*) as count FROM candidates c WHERE (c.conf_date BETWEEN :stDate AND :endDate) AND (c.units_id = :units_id) ORDER BY c.inscription_date";

			$params = array(':stDate' => $stDate, ':endDate' => $endDate, ':units_id' => $units_id);

			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertCandidate
     * Insert a new candidate
     * @return int count of records affected by running the sql statement into candidates.
     */
	public function insertCandidate(){
		try {
			
			$dbc = new DBConnection($this->dbconfig);

			$dbc->beginTransaction();

			$pId = $this->parents->insertParent();

			$aId = $this->address->insertAddress();			

			$sql = "INSERT INTO candidates (name,birth_date,tel1,tel2,inscription_date,situation,obs,conf_date,units_id,parents_id) VALUES (:name,:birth_date,:tel1,:tel2,:inscription_date,:situation,:obs,:conf_date,:units_id,:parents_id)";

			$params = array(":name"=>$this->name,
							":birth_date"=>$this->birth_date,
			 				":tel1"=>$this->tel1,
			 				":tel2"=>$this->tel2,
			 				":inscription_date"=>$this->inscription_date,
			 				":situation"=>$this->situation,
			 				":obs"=>$this->obs,
			 				":conf_date"=>$this->conf_date,
			 				":units_id"=>$this->units_id,
			 				":parents_id"=>$pId
			 				);

			$cId = $dbc->runQuery($sql,$params,1);
			
			$fields = array('addresses_id' => $aId, 'candidates_id' => $cId);
			$this->CandidateAddress->setAttributes($fields);
			$this->CandidateAddress->insertRelationship();
			
			return $dbc->commit();

			} catch (PDOException $e) {
			echo "Erro linha: ".__LINE__.$e->getMessage();
			$dbc->rollBack();
		}
	}

	/* Function deleteCandidate
     * Delete a candidate
     * @param $id candidate's id
     * @return int count of records affected by running the sql statement into candidate.
     */
	public function deleteCandidate($cid,$aid,$pid){
		try {
			$dbc = new DBConnection($this->dbconfig);

			$dbc->beginTransaction();

			$this->CandidateAddress->deleteRelationship($aid,$cid);

			$sql = "DELETE FROM `candidates` WHERE id = :id";
			$params = array(':id' => $cid);

			$dbc->runQuery($sql,$params);
			
			$this->parents->deleteParent($pid);
			$this->address->deleteAddress($aid);

			return $dbc->commit(); 
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
			$dbc->rollBack();
		}
	}

	/* Function updateCandidate
     * Update a candidate
     * @param $params array with Candidate's atributes
     * @return int count of records affected by running the sql statement into candidates.
     */
	public function updateCandidate(array $params){
		try {
			$dbc = new DBConnection($this->dbconfig);

			$dbc->beginTransaction();

			$address = array('id' => $params['addresses_id'],'street' => $params['street'],'number' => $params['number'],'neighborhood' => $params['neighborhood']);
			$parents = array('id' => $params['parents_id'],'mother' =>$params['mother'],'father' =>$params['father']);

			$this->address->updateAddress($address);

			unset($params['parents_id'],$params['mother'],$params['father'],$params['addresses_id'],$params['street'],$params['number'],$params['neighborhood']);	
			

			$sql = "UPDATE `candidates` SET";
	        $comma = " ";
	        foreach ($params as $key => $value) {
	        	if ($key == "id") {
	        		continue;
	        	}
	            $sql.= $comma.$key." = :".$key;
	            $comma = ", ";
	        }

	        $sql.=" WHERE id = :id";
			
			$dbc->runQuery($sql,$params);

			$this->parents->updateParent($parents);

			return $dbc->commit(); 
		} catch (PDOException $e) {
			echo "Erro linha: ".__LINE__.$e->getMessage();
			$dbc->rollBack();
		}
	}

	/* Function pendingCandidates
     * Get all candidates from a specific unit that situation is zero
     * @param $uid units id
     * @return number of affected rows on candidates.
     */
	public function pendingCandidates($uid){
		try {
			$sql = "SELECT c.id cid, c.name cname, c.birth_date FROM candidates c 
					INNER JOIN units u ON u.id = c.units_id WHERE (u.id = :uid  AND c.classrooms_id IS NULL) ORDER BY c.name" ;
			$dbc = new DBConnection($this->dbconfig);	
			$params = array(':uid' => $uid);
			return $dbc->getQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}