<?php
namespace Antfuentes\Titan\Joomla;

use Antfuentes\Titan\Joomla\Database;

class Module extends Article{
	public function loadSections($routerId, $categoryParentId, $dir, $articleAlias){
		$this->routerId = $routerId;
		$this->categoryParentId = $categoryParentId;
		$dir .= '/views/com_content/article/';
		$dir .= $articleAlias;
		$this->sections($routerId, $dir, $articleAlias, $articleAlias);
	}
	
	public function getContentCatergoryAlias($alias){
		$db = new Database;
		$db->tables();
	
		$results = $db->q("SELECT * FROM `$db->categories` WHERE alias = '$alias'");
		$this->catid = $results[0]['id'];
		
		$results = $this->q("SELECT alias FROM `$db->categories` WHERE id = '$this->catid'");
		$this->alias = $results[0]['alias'];
		
		$results = $this->q("SELECT id FROM `$db->menu` WHERE alias = '$this->alias'");
		$this->itemId = $results[0]['id'];
		
		$results = $db->q("SELECT * FROM `$db->content` WHERE catid = '$this->catid' ORDER BY id DESC");
		return $results;
	}
}
?>