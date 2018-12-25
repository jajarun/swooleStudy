<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午6:22
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);//创建swoole tcp客户端
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
        var_dump(unserialize($res));
    }else{
        echo $res.PHP_EOL;
    }
}
$client->close();//关闭连接