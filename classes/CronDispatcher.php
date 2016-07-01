<?php

class CronDispatcher
{
	public function __construct(){}

	/**
     * Dispatch the cronjob with module name and action
     *
     * @param  int     $id_cron      The Api cron id
     * @param  string  $token 	     The Api token
     * @param  string  $module_name  The technical module name
     * @param  string  $action 	  	 The Action is the class to call in crons directory inside the module directory
     * @return Boolean Whether the execute has been successfull
     */
	public static function dispatch($id_cron, $token, $module_name, $action)
	{
		if(!static::checkToken()) {
			return false;
		}

		// Include the file in /modules/module_name/Module_nameAction.php
		include_once(dirname(__FILE__).'/../../'.$module_name.'/crons/'.ucfirst($module_name).ucfirst($action).'.php');

		$reflectionClass = new ReflectionClass(ucfirst($module_name).ucfirst($action));
		$class = $reflectionClass->newInstance();

		// If function execute doesn't exists
		// Log execution failed and return false;
		if(!method_exists($class, 'execute')) {
			CronLog::cronExecutePok($id_cron, "Function execute() doesn\'t exists in ".ucfirst($module_name).ucfirst($action).".php");
			return false;
		}

		// Execute
		if(!$class->execute(parse_str(Tools::getValue('params'), $output))) {
			CronLog::cronExecutePok($id_cron, "Execution failed with action ".ucfirst($action).", please contact the developper of ".$module_name." module.");
			return false;
		}
		else {
			CronLog::cronExecuteOk($id_cron, ucfirst($module_name).ucfirst($action)." executed successfully.");
			return true;
		}
	}

	/**
     * Check if token is set and if it is correct
     *
     * @return Boolean Whether token is correct or not
     */
	private static function checkToken()
	{
		if(!Tools::getIsset('token')) {
			return false;
		}

		if(Tools::getValue('token') != Configuration::get('CRONJOBS_TOKEN')) {
			return false;
		}

		return true;
	}
}