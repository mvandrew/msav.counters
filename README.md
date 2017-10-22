# msav.counters - подключение счётчиков Яндекс и Google для CMS 1С-Битрикс

[![npm version](https://badge.fury.io/js/npm.svg)](https://badge.fury.io/js/npm) [![npm version](https://badge.fury.io/js/bower.svg)](https://badge.fury.io/js/bower) [![devDependencies Status](https://david-dm.org/mvandrew/msav.counters/dev-status.svg)](https://david-dm.org/mvandrew/msav.counters?type=dev) [![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

Модуль 1С-Битрикс для подключения счётчиков аналитики Яндекс и Google, и подтверждения прав для Яндекс Вебмастер и Google Webmasters.

Счётчики и коды подтверждения подключаются к любой теме оформления без необходимости вносить изменения в исходный код шаблонов или страниц сайта.
## Поддерживаемые счётчики
* [Яндекс Метрика](https://metrika.yandex.ru/).
* [Яндекс Вебмастер](https://webmaster.yandex.ru/).
* [Google Analytics](https://analytics.google.com/).
* [Google Webmasters](https://www.google.com/webmasters/).
## Настройка
1. Откройте параметры модуля.
2. Выберите сайт, на котором нужно разместить счётчик.
3. Укажите код счётчика.
4. Установите флажок признака активности счётчика.
## История изменений
### Вер. 1.0.0
* Поддерживается только один сайт. Поддержка многосайтовости будет добавлена в следующих версиях.
* Счётчики работают во Front-End и Back-End. Возможность выбора условий показа счётчиков пранируется в будущих вестиях. 
* Яндекс Метрика - без настройки параметров счётчика. Код поддерживает скрытый счётчик с Вебвизором, без контроля хэша в адресной строке.
* Яндекс Вебмастер с проверкой по meta-тегу.
* Google Analytics - код счётчика по-умолчанию.
* Google Webmasters с проверкой по meta-тегу.
