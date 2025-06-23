<?php
namespace App\Configs;

class MysqlConfig
{
    private $props = [
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => '123456',
        'database' => 'prms',
        'exportPath' => __DIR__.'/../../storage/DbBackups'
    ];
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
        if (empty(self::$instance)){
            self::$instance = new MysqlConfig();
        }
        return self::$instance;
    }


    public function getProperty(string $key): string
    {
        return $this->props[$key];
    }
}