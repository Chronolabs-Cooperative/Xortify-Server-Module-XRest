<?php
function cardtypes_xsd(){
	$xsd = array();
	$i=0;
	$xsd['request'][$i++] = array("name" => "username", "type" => "string");
	$xsd['request'][$i++] = array("name" => "password", "type" => "string");
	
	$i=0;
	$xsd['response'][$i++] = array("name" => "cardtypes", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "made", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "data", "type" => "array");
	
	return $xsd;

}

function cardtypes_wsdl(){

}

function cardtypes_wsdl_service(){

}

?>