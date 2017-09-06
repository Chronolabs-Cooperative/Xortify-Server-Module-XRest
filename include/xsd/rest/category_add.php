<?php
function category_add_xsd(){
	$xsd = array();
	$i=0;
	$xsd['request'][$i++] = array("name" => "username", "type" => "string");
	$xsd['request'][$i++] = array("name" => "password", "type" => "string");
	$xsd['request'][$i++] = array("name" => "categories", "type" => "array");
	
	$i=0;
	$xsd['response'][$i++] = array("name" => "categories_added", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "errors", "type" => "array");
	$xsd['response'][$i++] = array("name" => "made", "type" => "integer");
	
	return $xsd;
}

function category_add_wsdl(){

}

function category_add_wsdl_service(){

}


?>