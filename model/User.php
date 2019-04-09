<?php 
require_once('DBConnection.php');

Class User{

	private $name;

	private $email;

	private $password;

	private $admin;

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
        return "name: ". $this->name ."<br>email: " . $this->email ."<br>password: ".$this->password ."<br>admin: ".$this->admin;
    }

    /* Function getUsers
     * Get all users
     * @return Associate array unit
     */
	function getUsers(){
		try {
			$sql = "SELECT * FROM `users` ";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function getUser
     * Get a user by id
     * @param $id address in database
     * @return a single row with a Address
     */
	function getUser($id){
		try {
			$sql = "SELECT * FROM `users` WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->getQuery($sql,$id);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function insertUser
     * Insert a new user
     * @return int count of records affected by running the sql statement into users.
     */
	function insertUser(){
		try {
			$sql = "INSERT INTO `users` (name, email, password, admin) VALUES (:name, :email, :password, :admin)";
			$params = array(':name' => $this->name,
							':email' => $this->email,
							':password' => $this->password,
							':admin' => $this->admin);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function deleteUser
     * Delete a user
     * @param $id user's id
     * @return int count of records affected by running the sql statement into address.
     */
	function deleteUser($id){
		try {
			$sql = "DELETE FROM `users` WHERE id = :id";
			$params = array(':id' => $id);
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	/* Function updateUser
     * Update a user
     * @param $params array with User's atributes
     * @return int count of records affected by running the sql statement into user.
     */
	function updateAddress(array $params){
		try {
			$sql = "UPDATE `users` SET name = :name, email = :email, password = :password WHERE id = :id";
			$dbc = new DBConnection($this->dbconfig);
			return $dbc->runQuery($sql,$params);
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}