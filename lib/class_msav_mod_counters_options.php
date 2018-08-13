<?php

namespace Msav\Module\Counters;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;

/**
 * Class CMsavModCountersOptions - Класс доступа к параметрам модуля
 * @package Msav\Module\Counters
 * @author Andrey Mishchenko
 * @since 1.0.0
 */
class CMsavModCountersOptions
{
    /**
     * Экземпляр текущего класса
     * @var CMsavModCountersOptions
     */
    private static $INSTANCE = null;

    /**
     * Признак активности модуля
     * @var bool
     */
    public $active;

    /**
     * Ид.счётчика Яндекс.Метрика
     * @var string
     */
    public $yandex_metrika;

    /**
     * Код подтверждения Яндекс Вебмастер
     * @var string
     */
    public $yandex_webmaster;

    /**
     * Идентификатор отслеживания Google Analytics
     * @var string
     */
    public $google_analytics;

    /**
     * Код подтверждения Google Webmasters
     * @var string
     */
    public $google_webmasters;

    /**
     * CMsavModCountersOptions constructor.
     */
    public function __construct() {

	    try {

	    	$this->active               = Option::get( CMsavModCountersHelper::$MODULE_ID, 'active' );

		    $this->yandex_metrika       = Option::get(CMsavModCountersHelper::$MODULE_ID, 'yandex_metrika');
		    $this->yandex_webmaster     = Option::get(CMsavModCountersHelper::$MODULE_ID, 'yandex_webmaster');

		    $this->google_analytics     = Option::get(CMsavModCountersHelper::$MODULE_ID, 'google_analytics');
		    $this->google_webmasters    = Option::get(CMsavModCountersHelper::$MODULE_ID, 'google_webmasters');

	    } catch ( ArgumentNullException $e ) {
	    	AddMessage2Log($e->getMessage());
	    } catch ( ArgumentOutOfRangeException $e ) {
		    AddMessage2Log($e->getMessage());
	    }

    } // __construct

    /**
     * Возвращает экземпляр текущего класса
     *
     * @return CMsavModCountersOptions
     */
    public static function get_instance() {

        if (self::$INSTANCE == null) {
            self::$INSTANCE = new CMsavModCountersOptions();
        }

        return self::$INSTANCE;

    } // get_instance
}