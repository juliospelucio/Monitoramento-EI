<?php
/*
 * Class DBConnection
 * Create a database connection using PDO
 * @author jonahlyn@unm.edu
 */
Class DBConnection extends PDO{
    
    // Database Connection Configuration Parameters
    // array('driver' => 'mysql','host' => '','dbname' => '','username' => '','password' => '','options' => '',)
    protected $_config;

    // Database Connection
    public $dbc;

    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct(array $config) {
        $this->_config = $config;

        parent::__construct("mysql:host=localhost;dbname=".$config['dbname'], $config['username'], $config['password'], array('charset'=>'utf8'));
        $this->getPDOConnection();
    }
    
    /* Function getPDOConnection
     * Retrieve a connection to the database using PDO.
     */
    private function getPDOConnection() {
        // Check if the connection is already established
        if ($this->dbc == NULL) {
            $this->createConnection();
        }
    }

    /* Function createConnection
     * Create a the database connection using PDO.
     */
    private function createConnection(){
        $dsn = "" .
            $this->_config['driver'] .
            ":host=" . $this->_config['host'] .
            ";dbname=" . $this->_config['dbname'];
        try {
            $this->dbc = new PDO( $dsn, $this->_config[ 'username' ], $this->_config[ 'password' ], $this->_config['options']);
            $this->dbc->exec("set names utf8");
        } catch(PDOException $e ) {
            echo __LINE__.$e->getMessage();
        }
    }

    /* Function runQuery
     * Runs a insert, update or delete query
     * @param string sql insert update or delete statement
     * @param array with all parameters names
     * @param if is a insert query, is set true
     * @return int id of last inserted query
     */
    public function runQuery($sql, array $params = null, $insert = null ) {
        try {
            $stmt = $this->dbc->prepare($sql);
            $stmt->execute($params) or print_r($this->dbc->errorInfo());
            if ($insert) {
                return $this->dbc->lastInsertId(); 
            }
        } catch(PDOException $e) {
            echo "Database: ".__LINE__.$e->getMessage();
        }
        return $stmt->rowCount();
    }

    /* Function getQuery
     * Runs a select query
     * @param string sql insert update or delete statement
     * @returns associative array
     */
    public function getQuery($sql,array $params = null) {
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($params);
        // echo $stmt->debugDumpParams() . "<br />";
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}