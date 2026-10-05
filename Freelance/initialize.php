<?php
// Settings come from environment variables on Render.
// The fallbacks are for running locally on XAMPP/WAMP.
if(!defined('base_url')){
    $env_url = getenv('BASE_URL');
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    if($env_url){
        $url = rtrim($env_url,'/').'/';
    }elseif(preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host)){
        $url = 'http://localhost/freelance/';
    }else{
        $proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
        $url = $proto.'://'.$host.'/';
    }
    define('base_url', $url);
}
if(!defined('base_app'))    define('base_app', str_replace('\\','/',__DIR__).'/');
if(!defined('DB_SERVER'))   define('DB_SERVER', getenv('DB_HOST') ?: 'localhost');
if(!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USER') ?: 'root');
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASS') ?: '');
if(!defined('DB_NAME'))     define('DB_NAME', getenv('DB_NAME') ?: 'db_freelance');
if(!defined('DB_PORT'))     define('DB_PORT', (int)(getenv('DB_PORT') ?: 3306));
if(!defined('DB_SSL'))      define('DB_SSL', getenv('DB_SSL') === 'true');
?>
