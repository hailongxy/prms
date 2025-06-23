<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

@session_start();

use App\Configs\MysqlConfig;
use App\Console\Commands\ExportDB;

require __DIR__.'/vendor/autoload.php';

$mysqlConfig = MysqlConfig::getInstance();

$con = mysqli_connect($mysqlConfig->getProperty('host').":".$mysqlConfig->getProperty('port'),$mysqlConfig->getProperty('user'),$mysqlConfig->getProperty('password'),$mysqlConfig->getProperty('database'));
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_query($con, "set names utf8");
@session_start();
@ini_set('session.gc_maxlifetime',86400);
global $topic_menu;
$topic_menu = array();

if(isset($_SESSION['userid'])){

	$result = mysqli_query($con,"SELECT * FROM topic_control where userid = '".$_SESSION['userid']."' and display = 1 order by weight desc,id desc");
	while($row = mysqli_fetch_array($result)){

		$topic_menu[$row['id']] = $row['title'];
	}

	$result = mysqli_query($con,"SELECT * FROM mind_control where userid = '".$_SESSION['userid']."' and display = 1 order by weight desc,id desc");
	while($row = mysqli_fetch_array($result)){

		$mind_menu[$row['id']] = $row['title'];
	}

    $result = mysqli_query($con,"SELECT * FROM diagram_control where userid = '".$_SESSION['userid']."' and display = 1 order by weight desc,id desc");
    while($row = mysqli_fetch_array($result)){

        $diagram_menu[$row['id']] = $row['title'];
    }

}else if(!in_array($_SERVER['PHP_SELF'],['/controller/c_login.php'])){
	Header("Location:/login.php");
}

//rsort($topic_menu);
global $map_menu;
$map_menu = array(
    '0' => '研究流程图',
    '1' => '工作流程图',
    '2' => '生活流程图',
);
global $senior_topic_menu;
$senior_topic_menu = array(
    '0' => '得势',
    '1' => '忧乐专题',
    '2' => '口才突击',
    '3' => 'Show',
    '4' => 'wang专题',
    '5' => 'fangfang专题',
);

$exportDB = new ExportDB();
$exportDB->export();
