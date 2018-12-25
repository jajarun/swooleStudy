<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午1:42
 */

use Core\DbPool;
require '../config/config.php';
require '../autoload/autoload.php';
new DbPool($dbConfig);