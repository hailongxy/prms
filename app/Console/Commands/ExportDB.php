<?php
namespace App\Console\Commands;

use App\Configs\MysqlConfig;
use App\Utils\TimeUtil;
use Ifsnop\Mysqldump\Mysqldump;

class ExportDB
{
    private $host;
    private $port;
    private $user;
    private $password;
    private $database;
    private $exportPath;

    public function __construct()
    {
        $mysqlConfig = MysqlConfig::getInstance();
        $this->host = $mysqlConfig->getProperty('host');
        $this->port = $mysqlConfig->getProperty('port');
        $this->user = $mysqlConfig->getProperty('user');
        $this->password = $mysqlConfig->getProperty('password');
        $this->database = $mysqlConfig->getProperty('database');
        $this->exportPath = $mysqlConfig->getProperty('exportPath');
    }

    public function export()
    {
        $dump = new Mysqldump("mysql:host=" . $this->host . ";port=" . $this->port . ';dbname=' . $this->database, $this->user, $this->password);
        $file = TimeUtil::getDateTime("Y-m-d") . '_' . $this->database . ".sql";
        $fileFullPath = $this->exportPath . '/' . $file;
        if(!file_exists($fileFullPath))
        {
            $dump->start($fileFullPath);
        }
    }
}