<?php

class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        $sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    public function selectQ($sql){
        return $this->query($sql);
    }
    
    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data){
        
        $fieldNames = implode(', ', array_keys($data));
        $fieldValues = implode("', '", array_values($data));
        
        $sth = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ('$fieldValues')");

        $sth->execute();

        return $this->lastInsertId();
    }
    
    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where)
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach($data as $key => $value) {
            $fieldDetails .= "$key =:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');
        
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        
        return $sth;
    }

    public function merge($table, $data)
    {
        ksort($data);
        $fieldDetails = NULL;
        $fieldNames = NULL;
        $fieldValues = NULL;

        $fieldValues = implode("', '", array_values($data));

        foreach($data as $key => $value) {
            $fieldDetails .= "$key = values($key),";
        }

        $fieldNames = implode(', ', array_keys($data));
        $fieldNames = rtrim($fieldNames, ',');
        $fieldDetails = rtrim($fieldDetails, ',');
        
        $sth = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ('$fieldValues') ON DUPLICATE KEY UPDATE $fieldDetails");
        
        $sth->execute();
        
        return $sth;
    }
    
    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1){
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

    public function getNextId($tableName){
        return $this->select("SHOW TABLE STATUS like '$tableName'");
    }

        /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
}