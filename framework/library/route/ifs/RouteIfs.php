<?php

namespace top\library\route\ifs;

/**
 * 路由接口
 * @author topnuomi 2018年11月19日
 */
interface RouteIfs
{

    /**
     * 处理路由
     */
    public function processing();

    /**
     * 模块
     */
    public function module();

    /**
     * 控制器
     */
    public function ctrl();

    /**
     * 方法
     */
    public function method();

    /**
     * 解析参数
     */
    public function params();
}
