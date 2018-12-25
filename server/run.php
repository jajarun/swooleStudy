<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午1:42
 */

use Core\DbPool;

$config = include('../config/config.php');
new DbPool($config['db']);