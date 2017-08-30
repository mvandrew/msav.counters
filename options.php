<?php
/** @global CMain $APPLICATION */
/** @global CUser $USER */

use Bitrix\Main\Localization\Loc;
use Msav\Module\Counters\CMsavModCountersHelper;

$moduleId = 'msav.counters';

Loc::loadMessages(__FILE__);

if ( !$USER->IsAdmin() ) {
    return;
}

//
// Подготовка списка сайтов
//
//$arSites = CMsavModCountersHelper::get_sites_list();
//$siteId = $_REQUEST['site_id'] ? $_REQUEST['site_id'] : current(array_keys($arSites));


//
// Подготовка списка параметров
//
$arOptions = array(

    // Основные параметры
    Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_STEP_COMMON"),

    array(
        "active",
        Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_FIELD_ACTIVE"),
        "",
        array("checkbox", "")
    ),


    // Яндекс
    Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_STEP_YANDEX"),

    array(
        "yandex_metrika",
        Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_FIELD_YANDEX_METRIKA"),
        "",
        array("text", 20)
    ),

    array(
        "yandex_webmaster",
        Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_FIELD_YANDEX_WEBMASTER"),
        "",
        array("text", 20)
    ),


    // Google
    Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_STEP_GOOGLE"),

    array(
        "google_analytics",
        Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_FIELD_GOOGLE_ANALYTICS"),
        "",
        array("text", 20)
    ),

    array(
        "google_webmasters",
        Loc::getMessage("MD_MSAV_COUNTERS_OPTIONS_FIELD_GOOGLE_WEBMASTER"),
        "",
        array("text", 20)
    ),

);

$arTabs = array(
    array(
        "DIV" => "common_options",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "ICON" => "ib_settings",
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET")
    ),
);


//
// Обработка запроса
//
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && strlen($_REQUEST['save']) > 0 && check_bitrix_sessid() ) {

    __AdmSettingsSaveOptions( $moduleId, $arOptions );

    LocalRedirect($APPLICATION->GetCurPage() . '?lang=' . LANGUAGE_ID . '&mid=' . urlencode($moduleId));

}


//
// Отображение закладок
//
$obTabControl = new CAdminTabControl('tab_options', $arTabs);
printf('<form action="" method="post" name="%1$s">%2$s',
    $moduleId,
    bitrix_sessid_post()
);

$obTabControl->Begin();
$obTabControl->BeginNextTab();

__AdmSettingsDrawList($moduleId, $arOptions);

$obTabControl->Buttons(array('btnApply' => false, 'btnCancel' => false, 'btnSaveAndAdd' => false));
$obTabControl->End();

echo '</form>';
