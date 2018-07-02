<?php

namespace App;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\StdoutHandler;
use Monolog\Logger;

class MonologKafkaHandler extends AbstractProcessingHandler
{

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record)
    {
        $logger = new Logger('my_logger');
        $logger->pushHandler(new StdoutHandler());
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('kafka:9092');
        $config->setBrokerVersion('1.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer(
            function () use ($record) {
                return [
                    [
                        'topic' => 'test',
                        'value' => json_encode($record),
                        'key' => 0
                    ],
                ];
            }
        );
        $producer->setLogger($logger);
        $producer->success(function ($result) {
        });
        $producer->error(function ($errorCode) {
        });
        $producer->send(true);
    }
}