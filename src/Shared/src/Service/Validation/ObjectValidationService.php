<?php

declare(strict_types=1);

namespace Shared\Service\Validation;

use ApiCore\Exception\Config;
use ApiCore\Exception\ExceptionCore;
use ApiCore\Validation\ObjectCoreInterface;
use ApiCore\Validation\ValidatorCore;
use Http\StatusHttp;
use Shared\Exception\ObjectValidationException;

class ObjectValidationService implements ObjectValidationServiceInterface
{
    /**
     * @param ObjectCoreInterface|null $object
     * @throws ObjectValidationException
     */
    public function validateEntity(?ObjectCoreInterface $object): void
    {
        try {
            (new ValidatorCore())->validateCore($object);
        } catch (ExceptionCore $e) {
            throw new ObjectValidationException(
                (new Config())
                ->setArrayError($e->getCustomError())
                ->setStatusCode(StatusHttp::UNPROCESSABLE_ENTITY)
            );
        }
    }
}
