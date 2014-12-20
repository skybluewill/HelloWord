<?php

class Database extends PDO{
    
    public $db;                  //Database对象的引用变量
    private $pdo_statement=NULL;          // PDO Statement对象
    private $sql=NULL;                   //SQL语句
	public $DB_TYPE =1;
    
    public function __construct($DB_TYPE,$DB_HOST,$DB_NAME,$DB_USER,$DB_PWD) {
		var_dump($DB_TYPE);
        parent::__construct("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME",$DB_USER,$DB_PWD);
        //parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTIONS);
    }
    
    /**
     * 
     * @param string $statement
     * @return mixed
     */     
    private function pdo_prepare($statement){
        if(empty($statement)){
            return false;
        }else{
            return parent::prepare($statement);
        }
    }
    
    /**
     * 名称：pdo_execute Database类内部方法
     * @param string $statement SQL语句
     * @param array $array      含关联数组
     * @return boolean          成功时返回 TRUE， 或者在失败时返回 FALSE
     */
    private function pdo_execute($sql,$array=array()){
        $this->pdo_statement=$this->pdo_prepare($sql);
        try{
            foreach($array as $key=>$value){
                $this->pdo_statement->bindValue(":$key", $value);
            }
            //成功时返回 TRUE， 或者在失败时返回 FALSE。
            return $this->pdo_statement->execute();
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function exec($sql){
        if(empty($sql)){
            return false;
        }else{
            try{
                return ;parent::exec($sql);
            }  catch (PDOException $e){
                return $e->getMessage();
            }
        }
    }
    
    public function query($sql) {
        if(empty($sql)){
            return false;
        }
        return $this->pdo_statement=parent::query($sql);
    }
    
    /**
     * 
     * @param string $table_fields
     * @param string $db_table
     * @param string $query_condition
     * @param array $array
     * @param type $fetchMode
     * @return mixed
     */
    public function pdo_statement_select($table_fields=array(),$db_table,$query_condition=NULL,$array=array(),$fetchMode=PDO::FETCH_ASSOC){
        $fields=  implode($table_fields,',');
        $this->sql="SELECT $fields FROM  $db_table $query_condition";
        try{
            return $this->pdo_execute($this->sql, $array);
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    

    public function pdo_statement_insert($table,$data){
        ksort($data);
        $fieldName='`'.implode('`,`',array_keys($data)).'`';
        $fieldValues=':'.implode(',:',  array_values($data));
        $this->pdo_statement=$this->db_prepare( "INSERT INTO $table"." ($fieldName) "." VALUES ($fieldValues)");
        
        foreach ($data as $key => $value) {
            $this->pdo_statement->bindValue(":$key", $value);
        }
        
        if($this->pdo_statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    

    public function pdo_statement_update($table,$data,$where){ 
        ksort($data);
        $fieldDetails=null;
        
        foreach ($data as $key => $value) {
           $fieldDetails.='`'.$key.'`=:'.$key.',';  
        }
        
        $fieldDetails=rtrim($fieldDetails,', ');
        $this->pdo_statement=$this->prepare( " UPDATE $table SET $fieldDetails WHERE $where");
        
        foreach ($data as $key => $value) {
            $this->pdo_statement->bindValue(":$key", $value);
        }
        return $this->pdo_statement->execute()?:true;false;
    }
    

    public function pdo_statement_delete($table,$where=NULL,$limit=NULL){
        $this->sql="DELETE FROM $table $where LIMIT $limit";
        $this->pdo_prepare($this->sql);
        if($this->pdo_statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function fetch($fetch_type=PDO::FETCH_ASSOC){
        if(is_object($this->pdo_statement)){
            return $this->pdo_statement->fetch($fetch_type);
        }else{
            return false;
        }
    }
    
    public function pdo_select_fetch($table_fields, $db_table, $query_condition, $array, $fetchMode){
        if($this->pdo_statement_select($table_fields, $db_table, $query_condition, $array, $fetchMode)){
            return $this->fetch($fetchMode) ;
        }
        return false;
    }
    
    public function pdo_insert_fetch($table, $data,$fetchMode=PDO::FETCH_ASSOC){
        if($this->pdo_statement_insert($table, $data)){
            return $this->fetch($fetchMode);
        }
        return false;
    }
    
    public function pdo_update_fetch($table,$data,$where,$fetchMode=PDO::FETCH_ASSOC){
        if($this->pdo_statement_update($table, $data, $where)){
            return $this->fetch($fetchMode);
        }
        return false;
    }
    
    
}
