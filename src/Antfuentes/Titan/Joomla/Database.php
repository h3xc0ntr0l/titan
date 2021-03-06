<?php
namespace Antfuentes\Titan\Joomla;
use Antfuentes\Titan\Framework;

/*
* Database
*
* Please report bugs on https://github.com/antfuentes87/titan/issues
*
* @author Anthony Fuentes <antfuentes87@gmail.com>
* @author Shaun Farrell <shaunfarrell86@gmail.com>
* @copyright Copyright (c) 2015, MNDYRS. All rights reserved.
* @license MIT License
*/

class Database{
	public $link;
	
	function __construct(){
		$this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}else{
			mysqli_set_charset($this->link, 'utf8');
		}
	}

	function __destruct(){
		mysqli_close($this->link);
	}

	public function q($q){
		$data = array();
		$result = mysqli_query($this->link, $q);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
			}
		}
		return $data;
	}

	public function tables(){
		$array = $this->q('SHOW TABLES');
		foreach($array as $key => $val){	
			$table = explode('_', $val['Tables_in_'.DB_NAME]);
			$varname = $table[1];
			$this->$varname = $table[0].'_'.$table[1];
		}
	}

	public function columns($table){
		$array = $this->q('SHOW COLUMNS FROM '. $table);
		var_dump($array);
		foreach($array as $key => $val){
			$varname = $val['Field'];
			$this->$varname = $val['Field'];
		}
	}

	public function variables($results){
		foreach($results as $resultKey => $result){
			foreach ($result as $column => $data) {
				$this->{$column} = $data;
			}
		}
	}

	public function variable($result){
		foreach ($result as $column => $data) {
			$this->{$column} = $data;
		}
	}

	public function dump($dump){
		$h = new Framework\Html();
		$h->b('pre', 0, 1);
			var_dump($dump);
		$h->b('pre', 1, 1);
	}
}
?>