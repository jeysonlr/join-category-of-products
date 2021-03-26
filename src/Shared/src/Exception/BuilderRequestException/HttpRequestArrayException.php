<?php

declare(strict_types=1);

namespace Shared\Exception\BuilderRequestException;

use ApiCore\Exception\Config;
use Doctrine\Common\Collections\ArrayCollection;
use Shared\Exception\Common\RequestExternalException;

class HttpRequestArrayException extends RequestExternalException
{
    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var array
     */
    private array $arrayMessageError;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $errorsCollection;

    /**
     * HttpRequestArrayException constructor.
     *
     * @param int   $statusCode
     * @param array $arrayMessageError
     */
    public function __construct(int $statusCode, array $arrayMessageError)
    {
        parent::__construct((new Config())->setStatusCode($statusCode));
        $this->statusCode = $statusCode;
        $this->arrayMessageError = $arrayMessageError;
        $this->createError();
    }

    /**
     * @return void
     */
    private function createError(): void
    {
        $this->errorsCollection = new ArrayCollection();

        foreach ($this->arrayMessageError as $errorOperator) {
            $this->errorsCollection->add($errorOperator);
        }
    }

    /**
     * @return array
     */
    public function getArrayMessageError(): array
    {
        return $this->errorsCollection->toArray();
    }
}
