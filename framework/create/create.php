<?php

class Create
{

    private $name;

    private $start;

    private $namespace;

    private $base;

    private $dir;

    private $projectPath;

    public function __construct($start, $namespace, $name)
    {
        $this->name = $name;
        $this->dir = __DIR__ . '/';
        $this->namespace = $namespace;
        $this->base = $this->dir . '../../';
        if ($start)
            $this->start = $this->base . $start . '.php';
        $this->projectPath = $this->base . $this->namespace . '/' . $this->name . '/';
        $this->create();
    }

    public function replaceContent($content)
    {
        return str_replace([
            '{namespace}',
            '{name}'
        ], [
            $this->namespace,
            $this->name
        ], $content);
    }

    public function createStartFile()
    {
        if ($this->start && !file_exists($this->start)) {
            $content = file_get_contents($this->dir . 'tpl/index.tpl');
            $content = $this->replaceContent($content);
            if (file_put_contents($this->start, $content)) {
                return true;
            }
            exit('error -1');
        }
        return true;
    }

    public function createConfig()
    {
        $configPath = $this->projectPath . 'config/';
        $configFile = $configPath . 'config.php';
        if (!is_dir($configPath)) {
            mkdir($configPath, 0755, true);
        }
        if (!file_exists($configFile)) {
            $content = file_get_contents($this->dir . 'tpl/config/config.tpl');
            $content = $this->replaceContent($content);
            $realConfigFile = $this->base . '/' . $this->namespace . '/' . $this->name . '/config/config.php';
            if (!file_put_contents($configPath . 'config.php', $content)) {
                exit('error -2');
            }
        }
        return true;
    }

    public function createMVC()
    {
        $dirArray = [
            'controller',
            'model',
            'view'
        ];
        for ($i = 0; $i < count($dirArray); $i++) {
            if (!is_dir($this->projectPath . $dirArray[$i] . '/')) {
                mkdir($this->projectPath . $dirArray[$i] . '/', 0755, true);
            }
        }
        $controllerFile = $this->projectPath . 'controller/index.php';
        if (!file_exists($controllerFile)) {
            $content = file_get_contents($this->dir . 'tpl/controller/index.tpl');
            $content = $this->replaceContent($content);
            if (!file_put_contents($this->projectPath . 'controller/Index.php', $content)) {
                exit('error -4');
            }
        }
        $modelFile = $this->projectPath . 'model/demo.php';
        if (!file_exists($modelFile)) {
            $content = file_get_contents($this->dir . 'tpl/model/demo.tpl');
            $content = $this->replaceContent($content);
            if (!file_put_contents($this->projectPath . 'model/Demo.php', $content)) {
                exit('error -5');
            }
        }
        $viewFile = $this->projectPath . 'view/index/index.html';
        if (!file_exists($viewFile)) {
            $content = file_get_contents($this->dir . 'tpl/view/index.tpl');
            if (!is_dir($this->projectPath . 'view/index/')) {
                mkdir($this->projectPath . 'view/index/', 0755, true);
            }
            if (!file_put_contents($this->projectPath . 'view/Index/index.html', $content)) {
                exit('error -6');
            }
        }
    }

    public function createFunctions()
    {
        $file = $this->projectPath . 'functions.php';
        if (!file_exists($file)) {
            if (!file_put_contents($file, "<?php\r\n")) {
                exit('-7');
            }
        }
    }

    public function createRoute()
    {
        $file = $this->projectPath . '../route.php';
        if (!file_exists($file)) {
            if (!file_put_contents($file, file_get_contents($this->dir . 'tpl/route.tpl'))) {
                exit('-8');
            }
        }
    }

    public function create()
    {
        $this->createStartFile();
        $this->createConfig();
        $this->createMVC();
        $this->createFunctions();
        $this->createRoute();
    }
}

// 准备创建项目
$namespace = (isset($argv[1]) && $argv[1]) ? $argv[1] : exit('please type namespace~');
$projectName = (isset($argv[2]) && $argv[2]) ? $argv[2] : exit('please type project name~');
$startFile = (isset($argv[3]) && $argv[3]) ? $argv[3] : false;
new Create($startFile, $namespace, $projectName);
