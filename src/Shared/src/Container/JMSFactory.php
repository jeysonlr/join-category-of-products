<?php

declare(strict_types=1);

namespace Shared\Container;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Container\ContainerInterface;

final class JMSFactory
{
    public function __invoke(ContainerInterface $container): SerializerInterface
    {
        $loader = require __DIR__ . '/../../../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
        AnnotationRegistry::registerAutoloadNamespace(
            'Symfony\Component\Validator\Constraints',
            '/vendor/symfony/validator'
        );

        return SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }
}
