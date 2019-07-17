<?php 
require_once('Model.php');
require_once('Address.php');
require_once('Parents.php');
require_once('CandidatesAddresses.php');

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

	protected $parents;


	/* Function __construct
     * Set Atributes to the class
     * @param $name unit's name
     * @param $dbconfig is a db configuration arrays 
     */
	function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
		$this->address = new Address($dbconfig);
		$this->parents = new Parents($dbconfig);
		$this->CandidateAddress = new CandidatesAddresses($dbconfig);
	}

	/* Function getCandidates
     * Get all candidates
     * @return Associate array candidate
     */
	function getCandidates(){
		try {
			$sql = "SELECT c.id,c.name,c.birth_date,c.tel1,c.tel2,c.inscription_date,c.situation,p.mother,p.father 
					FROM `candidates` c 
					INNER JOIN `parents` p ON c.parents_id = p.id ";
					
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
			$dbc = new DBConnection($this->dbconfig);

			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation,
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

			$sql = "SELECT c.id cid, c.name cname, c.birth_date, c.tel1, c.tel2, c.inscription_date, c.situation,
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

	/* Function insertCandidate
     * Insert a new candidate
     * @return int count of records affected by running the sql statement into candidates.
     */
	function insertCandidate(){
		try {
			
			$dbc = new DBConnection($this->dbconfig);

			$dbc->beginTransaction();

			$pId = $this->parents->insertParent();

			$aId = $this->address->insertAddress();			

			$sql = "INSERT INTO candidates (name,birth_date,tel1,tel2,inscription_date,situation,units_id,parents_id) VALUES (:name,:birth_date,:tel1,:tel2,:inscription_date,:situation,:units_id,:parents_id)";

			$params = array(":name"=>$this->name,
							":birth_date"=>$this->birth_date,
			 				":tel1"=>$this->tel1,
			 				":tel2"=>$this->tel2,
			 				":inscription_date"=>$this->inscription_date,
			 				":situation"=>$this->situation,
			 				":units_id"=>$this->units_id,
			 				":parents_id"=>$pId
			 				);

			$cId = $dbc->runQuery($sql,$params,1);
			$fields = array('addresses_id' => $aId, 'candidates_id' => $cId);
			$this->CandidateAddress->setAttributes($fields);
			$this->CandidateAddress->insertRelationship();
			
			return $dbc->commit();

			//return $dbc->runQuery($sql,$params);
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
	function deleteCandidate($cid,$aid,$pid){
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
	function updateCandidate(array $params){
		try {
			$dbc = new DBConnection($this->dbconfig);

			/*echo "<pre>";
			print_r($params);
			echo "</pre>";
			exit;*/
			$dbc->beginTransaction();

			$address = array(':id' => $params['addresses_id'],':street' => $params['street'],':number' => $params['number'],':neighborhood' => $params['neighborhood']);//Address params
			$parents = array(':id' => $params['parents_id'],':mother' =>$params['mother'],':father' =>$params['father']);

			$this->address->updateAddress($address);

			unset($params['parents_id'],$params['mother'],$params['father'],$params['addresses_id'],$params['street'],$params['number'],$params['neighborhood']);	
			
			$sql = "UPDATE `candidates` SET name =:name, birth_date=:birth_date, tel1=:tel1, tel2=:tel2, situation=:situation, units_id=:units_id WHERE id = :id";
			/*echo "<pre>";
			print_r($params);
			echo "</pre>";
			exit;*/
			
			$dbc->runQuery($sql,$params);

			$this->parents->updateParent($parents);

			return $dbc->commit(); 
		} catch (PDOException $e) {
			echo "Erro linha: ".__LINE__.$e->getMessage();
			$dbc->rollBack();
		}
	}
}