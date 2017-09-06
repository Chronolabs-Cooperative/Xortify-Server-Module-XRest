<?php
	function xoops_get_session_key_xsd(){
		$xsd = array();
		$i=0;
		$xsd['request'][$i++] = array("name" => "username", "type" => "string");
		$xsd['request'][$i++] = array("name" => "password", "type" => "string");
	
		$i=0;
		$xsd['response'][$i++] = array("name" => "ERRNUM", "type" => "integer");
		$xsd['response'][$i++] = array("name" => "KEY", "type" => "string");
		
		return $xsd;
	}
	
	function xoops_get_session_key_wsdl(){
	
	}
	
	function xoops_get_session_key_wsdl_service(){
	
	}
	
	

?>