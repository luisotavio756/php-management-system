<?php  
	

	function breakDateTime($data){
		$aux = array();
		$d = explode(" ", $data);
		$aux['data'] = pbr($d[0]);
		$aux['horario'] = $d[1];

		return $aux;

	}

	function pbr($data){
		$d = explode('-', $data);
		$d = $d[2]."/".$d[1]."/".$d[0];

		return $d;
	}
	
?>