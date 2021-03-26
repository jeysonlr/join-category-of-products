<?php

declare(strict_types=1);

namespace Shared\Service\LoggerRequest;

use Shared\DTO\LoggerRequestDTO;

class LoggerRequestBuilder
{
    /**
     * @var string|null
     */
    private ?string
        $uri,
        $method,
        $directory = "",
        $requestBody,
        $responseBody;

    /**
     * @var array|null
     */
    private ?array $header;

    /**
     * @var float|null
     */
    private ?float $requestTime;

    /**
     * @var int|null
     */
    private ?int $responseStatus;

    /**
     * @return LoggerRequestService
     */
    public function buildLog(): LoggerRequestService
    {
        return new LoggerRequestService(
            $this->transferDatoForDTO()
        );
    }

    /**
     * @return LoggerRequestDTO
     */
    private function transferDatoForDTO(): LoggerRequestDTO
    {
        $loggerRequestDTO = new LoggerRequestDTO();
        $loggerRequestDTO->setUri($this->uri);
        $loggerRequestDTO->setHeader($this->header);
        $loggerRequestDTO->setMethod($this->method);
        $loggerRequestDTO->setDirectory($this->directory);
        $loggerRequestDTO->setRequestTime($this->requestTime);
        $loggerRequestDTO->setBodyRequest($this->requestBody);
        $loggerRequestDTO->setBodyResponse($this->responseBody);
        $loggerRequestDTO->setStatusResponse($this->responseStatus);

        return $loggerRequestDTO;
    }

    /**
     * @param string|null $uri
     * @return LoggerRequestBuilder
     */
    public function setUri(?string $uri): LoggerRequestBuilder
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array|null $header
     * @return LoggerRequestBuilder
     */
    public function setHeader(?array $header): LoggerRequestBuilder
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string|null $method
     * @return LoggerRequestBuilder
     */
    public function setMethod(?string $method): LoggerRequestBuilder
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string|null $directory
     * @return LoggerRequestBuilder
     */
    public function setDirectory(?string $directory): LoggerRequestBuilder
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @param float|null $requestTime
     * @return LoggerRequestBuilder
     */
    public function setRequestTime(?float $requestTime): LoggerRequestBuilder
    {
        $this->requestTime = $requestTime;
        return $this;
    }

    /**
     * @param string|null $requestBody
     * @return LoggerRequestBuilder
     */
    public function setBodyRequest(?string $requestBody): LoggerRequestBuilder
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    /**
     * @param string|null $responseBody
     * @return LoggerRequestBuilder
     */
    public function setBodyResponse(?string $responseBody): LoggerRequestBuilder
    {
        $this->responseBody = $responseBody;
        return $this;
    }

    /**
     * @param int|null $responseStatus
     * @return LoggerRequestBuilder
     */
    public function setStatusResponse(?int $responseStatus): LoggerRequestBuilder
    {
        $this->responseStatus = $responseStatus;
        return $this;
    }
}
