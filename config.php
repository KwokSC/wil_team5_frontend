<?php
define('DB_HOST', 'awseb-e-2q2p3w2xmx-stack-awsebrdsdatabase-kbfcrjcltpnk.c56i40ok0lqq.ap-southeast-2.rds.amazonaws.com:3306');
define('DB_USER', 'wilproject');
define('DB_PASS', 'haveagoodone05');
define('DB_NAME', 'ebdb');

function getDbConnection() {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($connection->connect_error) {
        die("Fail to connect: " . $connection->connect_error);
    }
    return $connection;
}
?>
