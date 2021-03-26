<?php

declare(strict_types=1);

namespace Shared\Util;

use Psr\Container\ContainerInterface;

class SerializerUtilFactory
{
    public function __invoke(ContainerInterface $container): SerializerUtil
    {
        $serializer = $container->get('serializer');
        return new SerializerUtil($serializer);
    }
}
