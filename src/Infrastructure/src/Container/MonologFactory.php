<?php

namespace Infrastructure\Container;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Psr\Container\ContainerInterface;

class MonologFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $dateFormat = "Y/m/d, H:i:s";
        $output = "%datetime% > %level_name% %message%";
        $formatter = new LineFormatter($output, $dateFormat, true);

        $logger = new Logger('Logs');
        $stream = new StreamHandler(
            __DIR__ . '/../../../../data/log/Internal/' . date('Y-m-d') . '.log');
        $stream->setFormatter($formatter);
        $logger->pushHandler($stream);
        return $logger;
    }
}
