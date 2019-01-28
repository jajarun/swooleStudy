<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/1/28
 * Time: 下午2:08
 */

$http = new Swoole\Http\Server("127.0.0.1", 9501);
$http->set(
    array(
        'reactor_num'=>2,
        'worker_num'=>4
    )
);
$http->on('request', function (Swoole\Http\Request $request, Swoole\Http\Response $response) {
    $data = $request->get;
    print_r($data);
    print_r($request->server);
    $response->end(rand(1000, 9999));
});
$http->start();