<?php

declare(strict_types=1);

namespace Shared\Service\Validation;

use ApiCore\Validation\ObjectCoreInterface;

interface ObjectValidationServiceInterface
{
    public function validateEntity(?ObjectCoreInterface $object): void;
}
