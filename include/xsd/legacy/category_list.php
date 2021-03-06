<?php
/**
 * Xortify API Function
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Coopertive (Australia)  http://web.labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         api
 * @author         	Simon Roberts (wishcraft) - meshy@labs.coop
 */

/*	Provide XSD for function
 *  category_list_xsd()
 *
 *  @subpackage plugin
 *
 *  @return array
 */
function category_list_xsd(){
	$xsd = array();
	$i=0;
	$data = array();
			$data[] = array("name" => "username", "type" => "string");
			$data[] = array("name" => "password", "type" => "string");	
			$data[] = array("name" => "records", "type" => "integer");	
			$data[] = array("name" => "start", "type" => "integer");
											 
	$xsd['request'][$i]['items']['data'] = $data;
	$xsd['request'][$i]['items']['objname'] = 'var';	
	$i=0;
	$xsd['response'][$i] = array("name" => "category_list", "type" => "integer");
	$i++;
	$xsd['response'][$i] = array("name" => "made", "type" => "integer");
	$datab=array();
	$datab[] = array("name" => "category_id", "type" => "integer");
	$datab[] = array("name" => "category_name", "type" => "string");
	$datab[] = array("name" => "category_type", "type" => "string");
		$data[] = array("items" => array("data" => $datab, "objname" => "data"));
	$i++;
	$xsd['response'][$i]['items']['data'] = $data;
	$xsd['response'][$i]['items']['objname'] = 'data';
	return $xsd;
}


/*	Provide WSDL for function
 *  category_list_wsdl()
 *
 *  @subpackage plugin
 *
 *  @return array
 */
function category_list_wsdl(){

}

/*	Provide WSDL Service for function
 *  category_list_wsdl_service()
 *
 *  @subpackage plugin
 *
 *  @return array
 */
 function category_list_wsdl_service(){

}

?>