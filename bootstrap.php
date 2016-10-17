<?php
/**
 * APP启动器
 * User: donghai
 * Date: 16/2/17
 * Time: 下午10:02
 */

//注册自动加载
require __DIR__ . '/vendor/autoload.php';

//定义目录
define('APP_PATH', __DIR__);
define('CONF_PATH', __DIR__ . '/config');
define('RESOURCES_PATH', __DIR__ . '/resources');
define('STORAGE_PATH', RESOURCES_PATH . '/storage');
define('THEME_PATH', RESOURCES_PATH . '/views/themes');
define('THEME', 'default');
define('APP_START_TIME', microtime(true));
define('APP_START_MEM', memory_get_usage());

//载入自定义函数
require __DIR__ . '/functions.php';

// 加载环境变量配置
$env = parse_ini_file(APP_PATH . '/.env', true);
foreach ($env as $key => $val) {
    $name = strtoupper($key);
    if (is_array($val)) {
        foreach ($val as $k => $v) {
            $item = $name . '_' . strtoupper($k);
            putenv("$item=$v");
        }
    } else {
        putenv("$name=$val");
    }
}

//加载APP配置
$database = require CONF_PATH . '/database.php';

//加载其他配置
date_default_timezone_set("PRC");

//Eloquent ORM
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();

// whoops 错误提示
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();