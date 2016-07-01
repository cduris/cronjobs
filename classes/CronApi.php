<?php
class CronApi
{

	const WEBSERVICE_URL = 'http://devmodule.prestashop.net/cduris/cronjobs2/public/';

	public function __construct()
	{

	}

	public static function registerDomain()
	{
		$token = $this->call(static::WEBSERVICE_URL.'domain', 'POST');

		if($token != '-1' && $token != '-2') {
			return Configuration::updateValue('CRONJOBS_TOKEN', $token);
		}

		CronLog::domainAddPok('Error while registering domain to the API, please contact our developpers.');

		return false;
	}

	public static function unregisterDomain($domain_name)
	{

	}

	public static function registerCron($module_name, $action, $params, $hour, $minute, $day, $day_of_week)
	{
		$data = array(
			'module_name' => $module_name,
			'action' => $action,
			'hour' => $hour,
			'minute' => $minute,
    		'day_of_month' => $day,
    		'day_of_week' => $day_of_week,
    		'one_shot' => false,
    		'params' => $params
		);

		$result = static::call(static::WEBSERVICE_URL.'cron', 'POST', $data);
		if(!$result->result) {
			CronLog::cronAddPok('Failed to add cron task.');
			return false;
		}

		return true;
	}

	public static function unregisterCron($module_name, $action, $params)
	{

	}

	private static function call($url, $type, $params = array())
	{
		$params['domain_name'] = _PS_BASE_URL_.__PS_BASE_URI__;
		$params['token'] = Configuration::get('CRONJOBS_TOKEN');

		$datas['method'] = $type;

		switch ($type) {
			case 'POST':
			case 'PUT':
			case 'PATCH':
				$datas['header'] = 'Content-type: application/x-www-form-urlencoded';
				$datas['content'] = http_build_query($params);
			break;
			case 'GET':
			case 'DELETE':
				$url .= '?'.http_build_query($params);
			break;
		}

		$opts = array('http' => $datas);

		$context  = stream_context_create($opts);

		return Tools::jsonDecode(Tools::file_get_contents($url, false, $context));
	}
}