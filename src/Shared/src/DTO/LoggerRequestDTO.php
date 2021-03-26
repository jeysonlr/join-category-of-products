<?php

declare(strict_types=1);

namespace Shared\DTO;

class LoggerRequestDTO
{
    /**
     * @var string|null
     */
    private ?string $uri;

    /**
     * @var array|null
     */
    private ?array $header;

    /**
     * @var string|null
     */
    private ?string $method;

    /**
     * @var string|null
     */
    private ?string $directory;

    /**
     * @var float|null
     */
    private ?float $requestTime;

    /**
     * @var string|null
     */
    private ?string $bodyRequest;

    /**
     * @var string|null
     */
    private ?string $bodyResponse;

    /**
     * @var int|null
     */
    private ?int $statusResponse;

    /**
     * @return string|null
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * @param string|null $uri
     */
    public function setUri(?string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return array|null
     */
    public function getHeader(): ?array
    {
        return $this->header;
    }

    /**
     * @param array|null $header
     */
    public function setHeader(?array $header): void
    {
        $this->header = $header;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string|null
     */
    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    /**
     * @param string|null $directory
     */
    public function setDirectory(?string $directory): void
    {
        $this->directory = $directory;
    }

    /**
     * @return float|null
     */
    public function getRequestTime(): ?float
    {
        return $this->requestTime;
    }

    /**
     * @param float|null $requestTime
     */
    public function setRequestTime(?float $requestTime): void
    {
        $this->requestTime = $requestTime;
    }

    /**
     * @return string|null
     */
    public function getBodyRequest(): ?string
    {
        return $this->bodyRequest;
    }

    /**
     * @param string|null $bodyRequest
     */
    public function setBodyRequest(?string $bodyRequest): void
    {
        $this->bodyRequest = $bodyRequest;
    }

    /**
     * @return string|null
     */
    public function getBodyResponse(): ?string
    {
        return $this->bodyResponse;
    }

    /**
     * @param string|null $bodyResponse
     */
    public function setBodyResponse(?string $bodyResponse): void
    {
        $this->bodyResponse = $bodyResponse;
    }

    /**
     * @return int|null
     */
    public function getStatusResponse(): ?int
    {
        return $this->statusResponse;
    }

    /**
     * @param int|null $statusResponse
     */
    public function setStatusResponse(?int $statusResponse): void
    {
        $this->statusResponse = $statusResponse;
    }
}
