<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午2:29
 */

namespace Core;
use Swoole\Server as SwooleServer;
use Helper\Log;


class DbPool{

    private $server = null;

    private $workerNum = 1;

    private $taskNum = 2;

    public function __construct($config)
    {
        $this->server = new SwooleServer('127.0.0.1','9905');
        $this->server->set([
            'worker_num' => $this->workerNum,
            'task_worker_num' => $this->taskNum
        ]);
        $this->server->on('onStart',[$this,'onStart']);
        $this->server->on('onWorkerStart',[$this,'onWorkerStart']);
    }

    private function run(){

    }

    private function onStart($server){
        Log::debug('DbPool start...');
    }

    private function onWorkerStart($server,$workerId){

    }

}