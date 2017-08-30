<?php

namespace Msav\Module\Counters;

use Bitrix\Main\EventManager;

/**
 * Класс модуля счётчиков
 *
 * Class CMsavModCounters
 * @package Msav\Module\Counters
 * @author Andrey Mishchenko
 * @since 1.0.0
 */
class CMsavModCountersHelper
{

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

    public static function on_page_start() {

    }

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