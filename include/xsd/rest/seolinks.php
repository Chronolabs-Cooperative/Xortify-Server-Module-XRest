<?php
function seolinks_xsd(){
$xsd = array();
	$i=0;
	$xsd['request'][$i++] = array("name" => "username", "type" => "string");
	$xsd['request'][$i++] = array("name" => "password", "type" => "string");
	$xsd['request'][$i++] = array("name" => "records", "type" => "integer");
	
	$i=0;
	$xsd['response'][$i++] = array("name" => "links", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "made", "type" => "integer");
	$xsd['response'][$i++] = array("name" => "data", "type" => "array");
	return $xsd;
}

function seolinks_wsdl(){

}

function seolinks_wsdl_service(){

}


?>