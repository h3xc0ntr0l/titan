<?php
namespace Antfuentes\Titan\Framework;

class String{	
	public function explode($array, $explode){
		return explode($explode, $array);
	}
	
	public function breakExplode($array){
		$results = explode('{BREAK}', $array);
		return $results;
	}

	public function breakExplodeVars($array){
		$results = explode('{BREAK}', $array);
		foreach($results as $resultKey => $result){
			$this->{'text_'.$resultKey} = trim($result);
		}
	}
	public function formatDate($dateFormat, $dateKey){
		return date($dateFormat, strtotime($dateKey));
	}

	public function formatGmDate($dateFormat, $timestamp){
		return gmdate($dateFormat, $timestamp);
	}
	
	public function between($left, $right, $in){
	    preg_match('/'.$left.'(.*?)'.$right.'/s', $in, $match);
	    return empty($match[1]) ? NULL : $match[1];
	}

	public function breakByGroupSize($groupSize, $array, $dir, $html){
		$this->array = $array;

		if($groupSize == 1){
			foreach($this->array as $this->key => $this->content){
			    require($dir.'/'.$html.'.php');
			}
		}else{
			$groupExit = $groupSize - 1;
			$data = count($this->array);
			$data = ($data / $groupSize) - 1;

			for ($z = 0; $z <= $data; $z++){
			    $this->key[] = $z;
			}

			foreach($this->key as $key => $val){
			    require($dir.'/'.$html.'.php');
			    for ($i = 0; $i <= $groupExit; $i++){
			        $this->key[$i] += $groupSize;
			    }    
			}
		}
	}

	public function replaceString($search, $replaceWith, $string){
		$cleanString = str_replace($search, $replaceWith, $string);
		return $cleanString;
	}
}
?>