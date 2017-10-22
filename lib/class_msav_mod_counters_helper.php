<?php

namespace Msav\Module\Counters;

use Bitrix\Main\EventManager;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Page\AssetLocation;

/**
 * Class CMsavModCounters - Класс модуля счётчиков
 * @package Msav\Module\Counters
 * @author Andrey Mishchenko
 * @since 1.0.0
 */
class CMsavModCountersHelper
{

    public static $MODULE_ID = 'msav.counters';

    /**
     * Возвращает список сайтов
     *
     * @return array
     */
    public static function get_sites_list() {

        $sort = "def";
        $order = "desc";

        $res = \CSite::GetList($sort, $order);

        $sites = array();
        while ($value = $res->Fetch()) {
            $sites[$value["LID"]] = $value["NAME"];
        }

        return $sites;

    } // get_sites_list

    /**
     * Обрабатывает отображение страницы.
     *
     * Добавляет счётчики, если они заданы и активированы.
     *
     * @return void
     */
    public static function on_page_start() {

        AddEventHandler('main',
            'OnEndBufferContent',
            array(__CLASS__, 'on_end_buffer_content')
        );

        $options = CMsavModCountersOptions::get_instance();

	    if ( $options->active ) {

            // Яндекс Вебмастер
            if ( strlen($options->yandex_webmaster) > 0 ) {
                $metaValue = sprintf('<meta name="yandex-verification" content="%s">', $options->yandex_webmaster);
                Asset::getInstance()->addString($metaValue);
            }

            // Google Webmaster
            if ( strlen($options->google_webmasters) > 0 ) {
                $metaValue = sprintf('<meta name="google-site-verification" content="%s" />', $options->google_webmasters);
                Asset::getInstance()->addString($metaValue);
            }

        }

    } // on_page_start

    public static function on_end_buffer_content( &$content ) {

        $options = CMsavModCountersOptions::get_instance();
        $counters = '';

        if ( $options->active ) {

            // Яндекс Метрика
            if ( strlen($options->yandex_metrika) > 0 ) {
                $templateFile = __DIR__ . '/../templates/yandex_metrika.tpl';
                if ( file_exists($templateFile) && ($handler = fopen($templateFile, "r")) ) {
                	$strBuffer = fread($handler, filesize($templateFile));
                	fclose($handler);
                	$strBuffer = preg_replace('#\[\[yandex_metrika\]\]#', $options->yandex_metrika, $strBuffer);
                	$counters .= $strBuffer;
                }
            }

            // Google Analytics
            if ( strlen($options->google_analytics) > 0 ) {
	            $templateFile = __DIR__ . '/../templates/google_analytics.tpl';
	            if ( file_exists($templateFile) && ($handler = fopen($templateFile, "r")) ) {
		            $strBuffer = fread($handler, filesize($templateFile));
		            fclose($handler);
		            $strBuffer = preg_replace('#\[\[google_analytics\]\]#', $options->google_analytics, $strBuffer);
		            $counters .= $strBuffer;
	            }
            }

        }

        // Отображение счётчиков на странице
        if ( $counters != '' ) {
            $pattern = '/<body[^>]*>/';
            $replacement = sprintf('$0 %s', $counters);
            $content = preg_replace($pattern, $replacement, $content);
        }

    } // on_end_buffer_content

    public static function register($module_id) {
        EventManager::getInstance()->registerEventHandler("main",
            "OnPageStart",
            $module_id,
            __CLASS__,
            "on_page_start");
    }

    public static function unregister($module_id) {
        EventManager::getInstance()->unRegisterEventHandler("main",
            "OnPageStart",
            $module_id,
            __CLASS__,
            "on_page_start");
    }

}