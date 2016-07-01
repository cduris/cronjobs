<?php
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/classes/CronDispatcher.php');
include_once(dirname(__FILE__).'/classes/CronLog.php');

CronDispatcher::dispatch(Tools::getValue('id_cron'), Tools::getValue('token'), Tools::getValue('module_name'), Tools::getValue('action'));