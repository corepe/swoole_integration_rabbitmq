<?php
error_reporting(E_ALL^E_NOTICE);
date_default_timezone_set('Asia/Shanghai');

class server
{
    private $serv;
    private $mq_exchange_name = "swoole_exchanger_name";
    private $mq_queue_name="swoole_queue_name";
    private $mq=array();




    public function __construct() {


        $this->serv = new swoole_http_server(
            "0.0.0.0",
            "9501"
        );

        $this->serv->set(array(
            'worker_num' => 8,   //worker number
            'max_conn' => 1000,
            'max_request' => 100000,
            'debug_mode'=> 1,
            'task_worker_num'=>8
            //'daemonize' => true, //Is start Daemon process
        ));


        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('WorkerStart', array($this, 'onWorkerStart'));
        $this->serv->on('connect', array($this, 'onConnect'));
        $this->serv->on('request' , array( $this , 'onRequest'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));
        $this->serv->on('Task', array($this, 'onTask'));
        $this->serv->on('Finish', array($this, 'onFinish'));
        $this->serv->start();
    }

    public function onStart( $serv ) {
        echo "Start\n";
    }

    public function onRequest($request, $response){

        $this->serv->task(json_encode($request));
        $response->end("hello swoole rabbitmq");
    }
    public function onConnect($serv, $fd){

        echo "Connected\n";
    }

    public function onWorkerStart( $serv , $worker_id) {
        //Only deal with worker task to connect rabbitmq!!!
        if( $worker_id >= $serv->setting['worker_num'] ) {
            $serv->mq['conn'] = new AMQPConnection();
            $serv->mq['conn'] ->setHost('127.0.0.1');
            $serv->mq['conn'] ->setLogin('guest');
            $serv->mq['conn'] ->setPassword('guest');
            $serv->mq['conn'] ->connect();
            $serv->mq['channel'] = new AMQPChannel($serv->mq['conn']);

            $serv->mq['exchange'] = new AMQPExchange($serv->mq['channel']);
            $serv->mq['exchange']->setType(AMQP_EX_TYPE_DIRECT);
            $serv->mq['exchange']->setName($this->mq_exchange_name);
            $serv->mq['exchange']->declareExchange();

            $serv->mq['queue'] = new AMQPQueue($serv->mq['channel']);
            //$serv->mq['queue']->setFlags(AMQP_EXCLUSIVE);
            $serv->mq['queue']->setName($this->mq_queue_name);
            $serv->mq['queue']->declareQueue();

            $serv->mq['queue']->bind($this->mq_exchange_name, $this->mq_queue_name);
        }
    }


    public function onReceive(swoole_server $serv, $fd, $from_id, $data){
        $serv->task("");
    }

    public function onClose( $serv, $fd, $from_id ) {
        echo "Client {$fd} close connection\n";
    }




    public function onTask($serv,$task_id,$from_id, $data) {
        //send msg to rabbitmq
        $serv->mq['exchange']->publish($data,$this->mq_queue_name);

    }

    public function onFinish($serv,$task_id, $data) {

    }

}

new server();