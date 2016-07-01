<?php
/**
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2016 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class CronLog extends ObjectModel
{
	const CRON_ADD_POK = 100;

	const CRON_EXECUTE_OK = 201;

	const CRON_EXECUTE_POK = 200;

    const DOMAIN_ADD_POK = 300;

	/**
     * Logging levels from syslog protocol defined in RFC 5424
     *
     * @var array $levels Logging levels
     */
    private static $levels = array(
        self::CRON_ADD_POK		=> 'CRON_ADD_POK',
        self::CRON_EXECUTE_OK   => 'CRON_EXECUTE_OK',
        self::CRON_EXECUTE_POK  => 'CRON_EXECUTE_POK',
        self::DOMAIN_ADD_POK      => 'DOMAIN_ADD_POK'
    );

    public function __construct()
    {
    }

	/**
     * Adds a log record.
     *
     * @param  int     $level   The logging level
     * @param  int     $id_cron The Api cron id
     * @param  string  $message The log message
     * @return Boolean Whether the record has been processed
     */
	private static function addRecord($level, $id_cron = null, $message = null)
	{
		return Db::getInstance()->insert('cronjobs_log', array('id' => 'NULL', 'id_cron' => $id_cron, 'level' => $level, 'message' => $message, 'date_add' => date('Y-m-d H:i:s')));
	}

	public static function cronAddPok($message = null)
	{
		return static::addRecord(static::CRON_ADD_POK, null, $message);
	}

	public static function cronExecuteOk($id_cron, $message = null)
	{
		return static::addRecord(static::CRON_EXECUTE_OK, $id_cron, $message);
	}

	public static function cronExecutePok($id_cron, $message = null)
    {
        return static::addRecord(static::CRON_EXECUTE_POK, $id_cron, $message);
    }

    public static function domainAddPok($message = null)
    {
        return static::addRecord(static::DOMAIN_ADD_POK, null, $message);
    }

    /**
     * Gets the name of the logging level.
     *
     * @param  int    $level
     * @return string
     */
    private static function getLevelName($level)
    {
        return static::$levels[$level];
    }
}