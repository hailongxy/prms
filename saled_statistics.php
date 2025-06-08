<?php
/**
 * Created by PhpStorm.
 * User: fangf
 * Date: 2017/8/5
 * Time: 8:01
 */

//phpinfo();

//exit;

$con = mysqli_connect("127.0.0.1:3306", "root", "hehe3344","prms");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_query($con, "set names utf8");

$result = mysqli_query($con,"SELECT * FROM topic_control");
while($row = mysqli_fetch_array($result)){

    print_r($row);
}
