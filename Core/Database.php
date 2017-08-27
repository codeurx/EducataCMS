<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 11:19
 */

namespace CMS;

use PDO;
use PDOException;
use Symfony\Component\Yaml\Yaml as Yml;
use CMS\Exception as Error;
use Webmozart\PathUtil\Path as Path;

class Database {

    public $hostname;
    public $database;
    public $username;
    public $password;
    public $pdo;
    public $sQuery;
    public $settings;
    public $bConnected = false;
    public $log;
    public $parameters;

    public function __construct($Path) {
        $Path = Path::canonicalize($Path);
        $configs = Yml::parse(file_get_contents($Path.'/Config/Database.yml'));
        $this->hostname = $configs['database']['host'];
        $this->database = $configs['database']['databasename'];
        $this->username = $configs['database']['username'];
        $this->password = $configs['database']['password'];
        $this->Connect($this->hostname, $this->database, $this->username, $this->password);
    }

    public function Connect($hostname, $database, $username, $password) {
        $dsn = 'mysql:dbname='.$database.';host='.$hostname;
        $this->pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $this->bConnected = true;
    }

    public function CloseConnection() {
        $this->pdo = null;
    }

    private function Init($query,$parameters = "") {
        if(!$this->bConnected){
            $this->Connect();
        }
        $this->sQuery = $this->pdo->prepare($query);
        $this->bindMore($parameters);
        if(!empty($this->parameters)) {
            foreach($this->parameters as $param) {
                $parameters = explode("\x7F",$param);
                $this->sQuery->bindParam($parameters[0],$parameters[1]);
            }
        }
        $this->success = $this->sQuery->execute();
        $this->parameters = array();
    }

    public function bind($para, $value) {
        $this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . utf8_encode($value);
    }

    public function bindMore($parray) {
        if(empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach($columns as $i => &$column)	{
                $this->bind($column, $parray[$column]);
            }
        }
    }

    public function query($query,$params = null, $fetchmode = PDO::FETCH_ASSOC) {
        $query = trim($query);
        $this->Init($query,$params);
        $rawStatement = explode(" ", $query);
        $statement = strtolower($rawStatement[0]);
        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->fetchAll($fetchmode);
        }elseif ($statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
            return $this->sQuery->rowCount();
        }else{
            return NULL;
        }
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function column($query,$params = null) {
        $this->Init($query,$params);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);
        $column = null;
        foreach($Columns as $cells) {
            $column[] = $cells[0];
        }
        return $column;
    }

    public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC) {
        $this->Init($query,$params);
        return $this->sQuery->fetch($fetchmode);
    }

    public function single($query,$params = null){
        $this->Init($query,$params);
        return $this->sQuery->fetchColumn();
    }
}
