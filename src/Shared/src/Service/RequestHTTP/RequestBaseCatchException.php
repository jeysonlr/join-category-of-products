<?php

declare(strict_types=1);

namespace Shared\Service\RequestHTTP;

use ApiCore\Exception\Config;
use GuzzleHttp\Exception\RequestException;
use Shared\Exception\BuilderRequestException\HttpRequestException;
use Shared\Exception\BuilderRequestException\HttpRequestArrayException;

class RequestBaseCatchException
{
    /**
     * @var mixed
     */
    private $response;

    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @param RequestException $exception
     * @throws HttpRequestArrayException
     * @throws HttpRequestException
     */
    public function checkRequestException(RequestException $exception): void
    {
        $this->response = $exception->getResponse();

        if (empty($this->response)) {
            return;
        }

        $this->statusCode = $this->response->getStatusCode() ?? $exception->getCode();
        $responseDecode = json_decode($this->response->getBody()->__toString());
        $this->response = !empty($responseDecode->error) ? $responseDecode->error : $responseDecode;

        $this->checkAndThrowError();
    }

    /**
     * @throws HttpRequestArrayException
     * @throws HttpRequestException
     */
    private function checkAndThrowError(): void
    {
        if (is_array($this->response)) {
            $this->responseArray();
            return;
        }
        $this->responseObject();
    }

    /**
     * @throws HttpRequestArrayException
     * @throws HttpRequestException
     */
    private function responseArray(): void
    {
        if (count($this->response) > 1) {
            throw new HttpRequestArrayException($this->statusCode, $this->response);
        }

        $error = $this->response[0] ?? null;

        if (!empty($error)) {
            $messageError = $error->messageerror ?? $error;
            $internalMessageerror = $error->internalmessageerror ?? null;
            throw new HttpRequestException(
                (new Config())
                ->setMessageError($messageError)
                ->setInternalMessageError($internalMessageerror)
                ->setStatusCode($this->statusCode)
            );
        }
    }

    /**
     * @throws HttpRequestException
     */
    private function responseObject(): void
    {
        $error = $this->response->error[0] ?? null;
        $messageError = $error->messageerror ?? null;

        if (!empty($messageError)) {
            $internalMessageerror = $error->internalmessageerror ?? null;
            throw new HttpRequestException(
                (new Config())
                    ->setMessageError($messageError)
                    ->setInternalMessageError($internalMessageerror)
                    ->setStatusCode($this->statusCode)
            );
        }
    }
}
