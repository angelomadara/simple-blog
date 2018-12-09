<?php 

/**
* 
*/
class Query extends DB
{
	private $str = '';

	function __construct(){
        $this->str = "";
    }

	public static function create( $table,$fields=[] ){

		if(count($fields)){
			$keys 	= array_keys($fields);
			$values = null;			
			$x 		= 1;
			foreach ( $fields as $field ) {
				$values .= '?';
				if($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`". implode('`, `', $keys) ."`) VALUES ({$values})";

			$handler = DB::ready()->_pdo;
			
			$statement = $handler->prepare( $sql );

			$x = 1;
			if(count($fields)){
				foreach ($fields as $field) {
					$statement->bindValue($x,$field);
					$x++;
				}
			}

			// $statement->execute(); 
				
			$statement->execute();
			return $handler;
			// if($statement->rowCount() > 0) return true;
			
			// else return false;

		}
		return false;
	}

	public function update($table,$fields=[],$id,$idRef){

		if(count($fields) <=0 ){			
			return false;
		}

		$set 	= '';
		$x		= 1;
		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ", ";
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE {$id} = {$idRef}";
		// die($sql);

		$handler = DB::ready()->_pdo;
			
		$statement = $handler->prepare( $sql );

		$y = 1;
		if(count($fields)){
			foreach ($fields as $field) {
				$statement->bindValue($y,$field);
				$y++;
			}
		}

		$statement->execute();
		return $handler;
	}

	public function select($table){
		$this->str .= 'SELECT * FROM `'.$table.'`';
		return $this;
	}

	public function where($field,$operator,$e){
		$this->str .= " WHERE `".$field."` ".$operator." '".$e."'";
		return $this;
	}

	public function and(){
		$this->str .= " AND ";
		return $this;
	}

	public function or(){
		$this->str .= " AND ";
		return $this;
	}

	public function orderBy($field,$order){
		$this->str .= " ORDER BY ".$field." ".$order;
		return $this;
	}

	public function get(){
		$a = $this->query_string($this->str);
		if($a) return $a;
		else return false;
	}

	public function first(){
		$a = $this->query_string($this->str);
		if($a) return $a[0];
		else return false;
	}

	public static function fetchAll($sql,$params=[]){
		return self::query_string($sql,$params);
	}

	public static function fetch($sql,$params=[]){
		$result = self::query_string($sql,$params);
		if(count($result)) return $result[0];
		else return [];
	}

	public static function query_string($query_string,$params=[]){
		$handler = DB::ready()->_pdo;
		$statement = $handler->prepare($query_string);
		$statement->execute($params); 
		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public static function remove($table,$fields=[]){
		$handler = DB::ready()->_pdo;

		$set 	= '';
		$x		= 1;
		$y 		= 0;
		$params = [];
		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= " AND ";
			}
			$params[$y] = $value;
			$x++; $y++;
		}

		$statement = $handler->prepare("DELETE FROM {$table} WHERE {$set}");
		$statement->execute($params); 
		return $statement->rowCount();
	}

	public static function raw($query_string,$params=[]){
		$handler = DB::ready()->_pdo;
		$statement = $handler->prepare($query_string);
		$statement->execute($params); 
		return $statement->rowCount();
	}

}
