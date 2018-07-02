<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Handler\StdoutHandler;
use Monolog\Logger;

class KafkaConsumerTestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:kafka:consume')
            ->setDescription('')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start.');

        $logger = new Logger('my_logger');
        $logger->pushHandler(new StdoutHandler());
        $config = \Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('kafka:9092');
        $config->setGroupId('test');
        $config->setBrokerVersion('1.0.0');
        $config->setTopics(['test']);
        $consumer = new \Kafka\Consumer();
        $consumer->setLogger($logger);
        $consumer->start(function ($topic, $part, $message) {
            if ($topic === 'test') {
                var_dump($message);
            }
        });
    }
}