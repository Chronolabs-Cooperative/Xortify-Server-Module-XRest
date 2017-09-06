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
if (!function_exists('xoops_get_session_key')) {
	
	/*	Xortify Authenticates a Standard Cloud Client User
	 *  xoops_get_session_key($username, $password, $auth)
	 *
	 *  @subpackage plugin
	 *
	 *  @param string $username 	Xortify username for function
	 *  @param string $password 	Xortify password or md5 hash of password for function
	 *  @param array $auth 			Xortify User Array [username, password(md5)]
	 *  @return array
 	 */
	function xoops_get_session_key($username, $password)
	{	

		global $xoopsModuleConfig, $xoopsConfig;
		
		if ($xoopsModuleConfig['site_user_auth']==1){
			if ($ret = check_for_lock(basename(__FILE__),$username,$password)) { return $ret; }
			if (!checkright(basename(__FILE__),$username,$password)) {
				mark_for_lock(basename(__FILE__),$username,$password);
				return array('ErrNum'=> 9, "ErrDesc" => 'No Permission for plug-in');
			}
		}

		$bans = file($GLOBALS['xoops']->path('/include/libs/banned-ips.txt'));
		xoops_load('UserUtility');
		$uu = new XoopsUserUtility();
		
		if (!in_array($uu->getIP(true), $bans)) {
			if (!isset($_SESSION['auth_session_key']))
				return array("ERRNUM" => 1, "KEY" => ($_SESSION['auth_session_key'] = sha1(XOOPS_DB_NAME.XOOPS_DB_PASS.XOOPS_DB_HOST.XOOPS_ROOT_PATH.microtime(true))));
			else 
				return array("ERRNUM" => 2, "KEY" => $_SESSION['auth_session_key']);
		} 
		
		return array("ERRNUM" => 0, "KEY" => sha1(NULL));

	}
}
?>