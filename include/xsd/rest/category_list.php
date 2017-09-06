<?php
function category_list_xsd(){
	$xsd = array();
	$i=0;
	$xsd['request'][$i++] = array("name" => "username", "type" => "string");
	$xsd['request'][$i++] = array("name" => "password", "type" => "string");
	$xsd['request'][$i++] = array("name" => "records", "type" => "integer");
	$xsd['request'][$i++] = array("name" => "start", "type" => "integer");
	
	$i=0;
	$xsd['response'][$i++] = array("name" => "category_list", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "made", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "data", "type" => "array");
	
	return $xsd;

}

function category_list_wsdl(){

}

function category_list_wsdl_service(){

}

?>