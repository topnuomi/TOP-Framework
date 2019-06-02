<?php

namespace top\library;

/**
 * 基础控制器
 *
 * @author topnuomi 2018年11月23日
 */
abstract class Controller {

    public function __construct() {}

    /**
     * 输出JSON数据
     * @param $msg
     * @param int $code
     * @param array $data
     * @param array $ext
     * @return false|string
     */
    public function json($msg, $code = 1, $data = [], $ext = []) {
        $array = [
            'msg' => $msg,
            'code' => $code,
            'data' => $data,
            'ext' => $ext
        ];
        return json_encode($array);
    }

    /**
     * 缓存页面（具体视图驱动完成此功能）
     * @param bool $status
     * @return $this
     */
    public function cache($status = true) {
        Register::get('View')->cache($status);
        return $this;
    }

    /**
     * 赋值到视图
     * @param $name
     * @param $value
     */
    public function param($name, $value) {
        Register::get('View')->param($name, $value);
    }

    /**
     * 渲染视图
     * @param string $file
     * @param array $param
     * @param bool $cache
     * @return mixed
     */
    public function fetch($file = '', $param = [], $cache = false) {
        return Register::get('View')->fetch($file, $param, $cache);
    }

    /**
     * 跳转（非ajax）
     * @param $url
     */
    public function redirect($url) {
        return redirect($url);
    }

    /**
     * 显示提示页面
     * @param $message
     * @param string $url
     * @param int $sec
     * @return false|mixed|string
     */
    public function tips($message, $url = '', $sec = 3) {
        if (request()->isAjax()) {
            return $this->json($message, '', 'tips', ['url' => $url, 'sec' => $sec]);
        } else {
            $viewConfig = Register::get('Config')->get('view');
            $tipsTemplate = $viewConfig['dir'] . 'tips.' . $viewConfig['ext'];
            (!file_exists($tipsTemplate)) && file_put_contents($tipsTemplate, '');
            return $this->fetch('tips', [
                'message' => $message,
                'url' => $url,
                'sec' => $sec
            ]);
        }
    }
}