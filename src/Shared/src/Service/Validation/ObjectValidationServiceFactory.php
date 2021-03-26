<?php

declare(strict_types=1);

namespace Shared\Service\Validation;

use Psr\Container\ContainerInterface;

class ObjectValidationServiceFactory
{
    public function __invoke(ContainerInterface $container): ObjectValidationService
    {
        return new ObjectValidationService();
    }
}
