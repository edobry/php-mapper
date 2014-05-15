<?php

class Mapper {
	private $mappings;
	private $mappers;

	private $db;

	public function Mapper($db) {
		$this->mappings = [ "Entry" => "diary-entries" ];
		$this->mappers = [ "Entry" => "entry_mapper" ];

		$this->db = $db;
	}

	private function entry_mapper($statement, $obj) {
		$classname = get_class($obj);
		$statement->bind_result($deid, $uid, $title, $time, $body, $lid, $multimedia);
		
		while ($statement->fetch()) {
	        $new_obj = new $classname();
	        call_user_func_array([$new_obj, "populate"], [$uid, $body, $time, []]);
	        $entities[] = $new_obj;
	    }
	    return $entities;
	}

	public function query($obj, $sql, $params) {
		$classname = get_class($obj);
		$sql = str_replace("<table>", '`'.$this->mappings[$classname].'`', $sql);
		$statement = $this->db->prepare($sql);
		
		if(count($params) > 0)
			call_user_func_array("$statement->bind_param", $params);
		$statement->execute();

		$entities = call_user_func_array([$this, $this->mappers[$classname]], [$statement, new $classname()]);

		$statement->close();
		
		// array_map(function ($row) { 
		// 	return $mappers[$classname]($result, new $classname());
		// }, $rows);

		return count($entities)>1 ? $entities : $entities[0]; 
	}
}
?>