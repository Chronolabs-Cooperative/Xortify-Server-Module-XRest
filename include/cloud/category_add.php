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

/*	Creates a category_add
 *  category_add($username, $password, $category_adds, $comments)
 *
 *  @subpackage plugin
 *
 *  @param string $username 	Xortify username for function
 *  @param string $password 	Xortify password or md5 hash of password for function
 *  @param array $category_adds 			Associative Array of Bans [0=>{ip4, ip6, proxy-ip4, proxy-ip6, long, network-addy, uname, email}]
 *  @param array $comments	 	Associative Array of Comments to go on all passing category_add in array group [0=>{comment}, 1=>{comment}]
 *  @return array
 */
function category_add($username, $password, $categories) {
	global $xoopsModuleConfig, $xoopsDB;
	
	
	if ($xoopsModuleConfig['site_user_auth']==1){
		if ($ret = check_for_lock(basename(__FILE__),$username,$password)) { return $ret; }
		if (!checkright(basename(__FILE__),$username,$password)) {
			mark_for_lock(basename(__FILE__),$username,$password);
			return array('ErrNum'=> 9, "ErrDesc" => 'No Permission for plug-in');
		}
	}
	
	$suid = user_uid($username, $password);
	
	$categoriesHandler =& xoops_getmodulehandler('categories', 'ban');
	
	$error=array();
	$create = array();
	foreach ($categories as $key => $category){	
		if ((isset( $category['category_name'] ) && !empty( $category['category_name'] )) && (isset( $category['category_type'] ) && !empty( $category['category_type'] ) && in_array($category['category_type'], file($GLOBALS['xoops']->path('/include/libs/category-enumeration.txt'))))) 
		{
			$category['category_name'] = ucwords($category['category_name']);
			
			$criteria = new CriteriaCompo(new Criteria('`category_name`', $category['category_name']));
	    	$criteria->add(new Criteria('`category_type`', $category['category_type']), 'AND');
	
			if ($categoriesHandler->getCount($criteria)>0) {
				$error[$key]['message'] = 'Category already exists for record - '.$criteria->renderWhere();
				$error[$key]['code'] = 'exists';
				
			} else {
				$error[$key]['message'] = 'Category does not exists for record, will create category on basis:~ '.$criteria->renderWhere();
				$error[$key]['code'] = 'creating';
				$create[$key] =  $category;
			}
		} else {
			$error[$key]['message'] = "Missing either field `category_name` or `category_type`; otherwise `category_type` is not an enumeration of one of the following options:~ " . implode(', ', file($GLOBALS['xoops']->path('/include/libs/category-enumeration.txt')));
			$error[$key]['code'] = 'missing';
		}
	}

	if (count($create)==0) 
		return array("category_added" => 0, "errors" => $error, "made" => time());		
	
	foreach ($create as $key => $category)
	{
		$newcat = $categoriesHandler->create();
		$newcat->setVars($category);
		$error[$key]['category_id'] = $categoriesHandler->insert($newcat, true);
	}
	
	return array("category_added" => count($create), "errors" => $error, "made" => time());
}

?>