<?php

use \top\Framework;

require '../framework/Framework.php';

// 可能你会使用到下面这些配置

// 调试模式，缺省值：false
// Framework::debug(true);
// 可使用常量DEBUG取得该值

// 项目目录，缺省值：./application/
// Framework::appPath('../application/');
// 可使用常量APP_PATH取得该值

// 项目命名空间，缺省值：app
// Framework::appNameSpace('app');
// 可使用常量APP_NS取得该值

// session保存目录，缺省值：./runtime/session/
// Framework::sessionPath('./runtime/session/');
// 可使用常量SESSION_PATH取得该值

// 框架目录，缺省值：Framework.php的绝对路径
// Framework::frameworkPath('../framework');
// 可使用常量FRAMEWORK_PATH取得该值

// 静态资源目录，缺省值：/resource/
// Framework::resourcePath('/resource/');
// 可使用常量RESOURCE取得该值

Framework::appPath('../application/');
Framework::bindModule('{name}');
Framework::startApp();
