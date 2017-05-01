<?php

	$mode = $_GET['mode'];
	
	if($mode == "register"){

		$jmledit = $_POST['jmledit'];
		$kode_brg = $_POST['kode_brg'];
		$jumlah = $_POST['jumlah'];			
	
		$arr = array("jmledit" => $jmledit,
					 "kode_brg" => $kode_brg,
					 "jumlah" => $jumlah);

		$return = json_encode($arr); //create json data
	
	}else if($mode == "search"){

		$search = $_GET['search'];	

		$return = $search; //return html data
	
	}else if($mode == "call"){

		$return = "Hey, how are you ?"; //HTML data
	
	}else if($mode == "call_mr_simple"){
		$friend = $_POST['friend'];			
		$with = $_POST['with'];			

		$arr = array("text" => "Hello $friend with $with");

		$return = json_encode($arr); //create json data
	
	}else if($mode == "some_special"){		

		$arr = array("text" => "Hey, i came from server!");

		$return = json_encode($arr); //create json data
	
	}
	
	echo $return; //return data to js


?>