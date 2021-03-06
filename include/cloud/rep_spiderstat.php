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
if (!function_exists('rep_spiderstat')) {
	

	/*	Reparsing Spider/Crawler Statistic
	 *  rep_spiderstat($username, $password, $statistic)
	 *
	 *  @subpackage plugin
	 *
	 *  @param string $username 	Xortify username for function
	 *  @param string $password 	Xortify password or md5 hash of password for function
	 *  @param array $statistic 	Statitic Array [netaddy, useragent, uri, ip, server-ip, when, sitename]
	 *  @return array
	 */
	function rep_spiderstat($username, $password, $statistic) {
		global $xoopsModuleConfig, $xoopsDB;
		
		if ($xoopsModuleConfig['site_user_auth']==1){
			if ($ret = check_for_lock(basename(__FILE__),$username,$password)) { return $ret; }
			if (!checkright(basename(__FILE__),$username,$password)) {
				mark_for_lock(basename(__FILE__),$username,$password);
				return array('ErrNum'=> 9, "ErrDesc" => 'No Permission for plug-in');
			}
		}
		
		$spider_handler = &xoops_getmodulehandler( 'spiders', 'spiders' );	
		$member_handler = &xoops_gethandler( 'member' );
		
		$modulehandler =& xoops_gethandler('module');
		$confighandler =& xoops_gethandler('config');
		$xoModule = $modulehandler->getByDirname('spiders');
		$xoConfig = $confighandler->getConfigList($xoModule->getVar('mid'),false);
	
		$statistics_handler =& xoops_getmodulehandler('statistics', 'spiders');
	
		$ban = $spider_handler->banDetails($statistic['netaddy']);
		
		if ($ban!=false) {
			return array("ban_made" => $ban, "made" => time());
		}
		
		$spiders = $spider_handler->getObjects(NULL);
		
		foreach($spiders as $spider) {
			if (strtolower($spider->getVar('robot-id'))==strtolower($statistic['robot-id'])) {
				$id = $spider->getVar('id');
				$thespider = $spider;
			}
		}
	
		$stat = $statistics_handler->create();
		$stat->setVar('id', $id);
		$stat->setVar('useragent', $statistic['useragent']);
		$stat->setVar('uri', $statistic['uri']);
		$stat->setVar('netaddy', $statistic['netaddy']);
		$stat->setVar('ip', $statistic['ip']);
		$stat->setVar('server-ip', $statistic['server-ip']);	
		$stat->setVar('when', $statistic['when']);		
		$stat->setVar('sitename', $statistic['sitename']);	
	
		$status = ($statistics_handler->insert($stat))?true:false;
		
		$sql = "DELETE FROM " . $GLOBALS['xoopsDB']->prefix('spiders_statistics') . " WHERE `when` < '".(time()-(24*60*60*3))."'";
		@$GLOBALS['xoopsDB']->queryF($sql);
			
		return array("stat_made" => $status, "made" => time());
	
	}
}
?>