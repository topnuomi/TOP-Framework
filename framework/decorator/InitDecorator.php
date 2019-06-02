<?php

namespace top\decorator;

use top\decorator\ifs\DecoratorIfs;
use top\library\Register;
use top\library\View;
use top\library\cache\FileCache;

/**
 * 初始化
 *
 * @author topnuomi 2018年11月20日
 */
class InitDecorator implements DecoratorIfs {

    /**
     * 注册一些可能会用到的类
     * @throws \Exception
     */
    public function before() {
        $route = Register::get('Router');

        $sessionConfig = Register::get('Config')->get('session');
        if (!empty($sessionConfig) && $sessionConfig['open'] === true) {
            session_start();
        }

        // 数据库驱动
        $config = Register::get('Config')->get('db');
        $driver = $config['driver'] ? $config['driver'] : 'MySQLi';
        Register::set('DBDriver', function () use ($driver) {
            $class = '\\top\\library\\database\\driver\\' . $driver;
            return $class::instance();
        });

        // 视图文件缓存
        Register::set('ViewCache', function () {
            return FileCache::instance();
        });

        // 配置文件中配置的注册
        $initRegister = Register::get('Config')->get('register');
        if (!empty($initRegister)) {
            foreach ($initRegister as $key => $value) {
                Register::set($key, function () use ($value) {
                    return $value::instance();
                });
            }
        }

        // 注册视图
        Register::set('View', function () {
            return View::instance();
        });

        // 加载系统函数库
        require FRAMEWORK_PATH . 'library/functions/functions.php';

        // 加载用户函数库
        $funcFile = APP_PATH . $route->module . '/functions.php';
        if (file_exists($funcFile)) {
            require $funcFile;
        }
    }

    /**
     * @param array $data
     */
    public function after($data) {
        // TODO Auto-generated method stub
    }
}