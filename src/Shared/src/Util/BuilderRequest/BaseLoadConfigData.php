<?php

declare(strict_types=1);

namespace Shared\Util\BuilderRequest;

use Psr\Container\ContainerInterface;

abstract class BaseLoadConfigData
{
    /**
     * @var ContainerInterface
     */
    private static ContainerInterface $container;

//    /**
//     * @return ContainerInterface
//     */
//    public static function getContainer(): ContainerInterface
//    {
//        return self::$container;
//    }
//
//    /**
//     * @param ContainerInterface $container
//     */
//    public static function setContainer(ContainerInterface $container): void
//    {
//        self::$container = $container;
//    }

    /**
     * @param mixed $configKeysArray
     * @return mixed
     */
    public static function getConfig(...$configKeysArray)
    {
        if (self::$container === null) {
            return null;
        }

        $keys = null;
        $config = self::$container->get("config");

        foreach ($configKeysArray as $index => $value) {
            $keys = ($index === 0 ? $config[$value] : $keys[$value]);
        }
        return $keys;
    }
}
