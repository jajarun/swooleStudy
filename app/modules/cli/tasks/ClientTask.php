<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/26
 * Time: 上午10:36
 */

namespace Modules\Cli\Tasks;
use Swoole\Client as SwooleClient;

class ClientTask
{

    public function runAction(){
        $client = new SwooleClient(SWOOLE_SOCK_TCP);//创建swoole tcp客户端
        $client->connect('127.0.0.1', 9905, 10) or die("connect error");//连接server
        while(true){
            echo "请输出要执行的sql: ";
            $sql = trim(fgets(STDIN));
            if($sql=='exit'){
                break;
            }
            $client->send($sql);//发送要执行的sql
            $data = $client->recv();//阻塞接受返回的结果
            list($status,$res) = explode(':',$data,2);
            if($status == 'OK'){
                print_r(unserialize($res));
            }else{
                echo $res.PHP_EOL;
            }
        }
        $client->close();//关闭连接
    }

}