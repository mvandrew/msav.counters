<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }

try {
	\Bitrix\Main\Loader::registerAutoLoadClasses( 'msav.counters', array(
		'Msav\Module\Counters\CMsavModCountersHelper'  => 'lib/class_msav_mod_counters_helper.php',
		'Msav\Module\Counters\CMsavModCountersOptions' => 'lib/class_msav_mod_counters_options.php',
	) );
} catch ( \Bitrix\Main\LoaderException $e ) {
	AddMessage2Log($e->getMessage());
}
