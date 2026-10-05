<?php
// All settings come from environment variables on Render.
// The fallbacks after ?: are for running locally on XAMPP/WAMP.
if(!defined('base_url'))    define('base_url', getenv('BASE_URL') ?: 'http://localhost/freelance/');
if(!defined('base_app'))    define('base_app', str_replace('\\','/',__DIR__).'/');
if(!defined('DB_SERVER'))   define('DB_SERVER', getenv('DB_HOST') ?: 'localhost');
if(!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USER') ?: 'root');
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASS') ?: '');
if(!defined('DB_NAME'))     define('DB_NAME', getenv('DB_NAME') ?: 'db_freelance');
if(!defined('DB_PORT'))     define('DB_PORT', (int)(getenv('DB_PORT') ?: 3306));
if(!defined('DB_SSL'))      define('DB_SSL', getenv('DB_SSL') === 'true');
?>
