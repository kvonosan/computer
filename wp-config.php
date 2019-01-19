<?php
define( 'WP_CACHE', true );
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'computer');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'test1234');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k~s}ScyIk!Ql<l40n!~JVSg,wcX$ j}F%?A>|i#P+6`S8cNsyzzJ`hkjG.e[>/!-');
define('SECURE_AUTH_KEY',  'rqjJ=*R[~yE4}ws)B{UG,16&)|wwM$U(!x2?Q[kC,%y|KWF[=E3B|OJazae!gqRW');
define('LOGGED_IN_KEY',    'h*Dc9_oQXqnjt>;-Ld+*^/_Ci+up!&F>sT|go8CXCfp]hf_F{AJ|^h$m=U1ZqY0;');
define('NONCE_KEY',        'O|0<WEG/XMl>nWQu9(Vs!nzc_H_;`edxfJMrBQvBfz!a]2:,8%};/q`5]$`T&CmQ');
define('AUTH_SALT',        'nX0NPI8jdG[VgAdDv;K(!kPppKq~^Y6x6BuX%0;jaX#PTHU 4.n+4^*Fg?!zZ*Kz');
define('SECURE_AUTH_SALT', '9,vIThfTsg5CAZ|z|-R>CU0{LNQ0$eO.]Rlna)(DuRx,f3>v`Vl0N-vw5r~G12M0');
define('LOGGED_IN_SALT',   'd)<GgZt@8,)P[wB|y$`h}w+0^g=u2^;z]^?w]k4nWXC_vgrNE(|!yf$M$z`0~xjn');
define('NONCE_SALT',       '![=n~,NWOV,2WwNb](o&?})$_5ICJ(5<}RI.I13.]Q!VHE14vN*fUM4%998s+na5');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
