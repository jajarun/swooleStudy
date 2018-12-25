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

    private $dbConfig = [];

    private $server = null;

    private $workerNum = 1;

    private $taskNum = 2;

    private $connect = null;

    public function __construct($config)
    {
        $this->dbConfig = $config;
        $this->server = new SwooleServer('127.0.0.1','9905');
        $this->server->set([
            'worker_num' => $this->workerNum,
            'task_worker_num' => $this->taskNum
        ]);
        $this->server->on('Start',[$this,'onStart']);
        $this->server->on('WorkerStart',[$this,'onWorkerStart']);
        $this->server->on('Receive',[$this,'onReceive']);
        $this->server->on('Task',[$this,'onTask']);
        $this->server->on('Finish',[$this,'onFinish']);

        $this->server->start();
    }

    public function onStart($server){
        Log::debug('DbPool start...');
    }

    public function onWorkerStart($server,$workerId){
        Log::debug('worker '.$workerId.' start...');
    }

    public function onReceive(SwooleServer $server,$fd,$fromId,$data){
        Log::debug('Receive data:'.$data);
        $result = $server->taskwait($data);
        Log::debug('sql query over');
        if($result !== false){
//            list($status,$res) = explode(':',$data,2);
            $server->send($fd,$data);
        }else{
            $server->send($fd,'Task error');
        }
    }

    public function onTask(SwooleServer $server,$taskId,$fromId,$data){
        if($this->connect == null){
            $this->connect = mysqli_connect($this->dbConfig['host'],$this->dbConfig['username'],$this->dbConfig['password'],$this->dbConfig['db_name'],$this->dbConfig['port']);
            if(!$this->connect){
                $server->finish('ER:'.mysqli_error($this->connect));
                $this->connect = null;
                return;
            }
        }
        $result = $this->connect->query($data);
        if(!$result){
            $server->finish('ER:'.mysqli_error($this->connect));
            return;
        }
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $server->finish('OK:'.serialize($data));
    }

    public function onFinish(SwooleServer $server,$taskId,$data){
        Log::debug('Task over data:'.$data);
    }

}