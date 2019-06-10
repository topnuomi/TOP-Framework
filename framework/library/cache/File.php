<?php
namespace top\library\cache;

use top\library\cache\ifs\CacheIfs;

class File implements CacheIfs {

    private static $instance;

    public static function instance() {
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \top\library\cache\CacheIfs::set()
     */
    public function set($name = '', $value = '') {
        // TODO Auto-generated method stub
        $dirArray = explode('/', $name);
        unset($dirArray[count($dirArray) - 1]);
        $dir = implode('/', $dirArray);
        if (! is_dir($dir)) {
            mkdir($dir, 775, true);
        }
        if (file_put_contents($name, $value) !== false) {
            return true;
        }
        return false;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \top\library\cache\CacheIfs::get()
     */
    public function get($name = '') {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \top\library\cache\CacheIfs::_unset()
     */
    public function _unset($name = '') {
        // TODO Auto-generated method stub
    }

    public function check($name = '', $time = 0) {
        if (file_exists($name)) {
            $modifyTime = filemtime($name);
            $nowTime = time();
            if ($nowTime - $modifyTime > $time) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}