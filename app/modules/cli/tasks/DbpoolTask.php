<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/26
 * Time: 上午10:35
 */

namespace Modules\Cli\Tasks;
use Common\Core\DbPool;
use Common\library\TaskBase;

class DbpoolTask extends TaskBase
{

    public function runAction(){
        new DbPool();
    }

}