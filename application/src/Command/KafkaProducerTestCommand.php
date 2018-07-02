<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Handler\StdoutHandler;
use Monolog\Logger;

class KafkaProducerTestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:kafka:produce')
            ->setDescription('')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start.');


        $logger = new Logger('my_logger');
        $logger->pushHandler(new StdoutHandler());
        $config = \Kafka\ProducerConfig::getInstance();
//        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('kafka:9092');
//        $config->setBrokerVersion('1.0.0');
//        $config->setRequiredAck(1);
//        $config->setIsAsyn(false);
//        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer(
            function () {
                return [
                    [
                        'topic' => 'test',
                        'value' => 'test string content value',
                        'key' => '8723v69482736n497826n86v7',
                    ],
                ];
            }
        );
//        $producer->setLogger($logger);
        $producer->success(function ($result) {
//            var_dump($result);
        });
        $producer->error(function ($errorCode) {
//            var_dump($errorCode);
        });
        $producer->send(true);
    }
}