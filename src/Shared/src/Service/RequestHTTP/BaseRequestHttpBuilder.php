<?php

declare(strict_types=1);

namespace Shared\Service\RequestHTTP;

use Exception;
use GuzzleHttp\Client;
use ApiCore\Exception\Config;
use GuzzleHttp\TransferStats;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Shared\Util\BuilderRequest\Http\Header;
use Shared\Service\LoggerRequest\LoggerRequestBuilder;
use Shared\Exception\BuilderRequestException\HttpRequestException;
use Shared\Exception\LoggerRequestException\LoggerRequestException;

class BaseRequestHttpBuilder
{
    /**
     * @var string|null
     */
    private ?string
        $host = "",
        $method = "",
        $uri = "",
        $body = "",
        $parameters = "",
        $token = "";

    /**
     * @var array
     */
    private array $header;

    /**
     * @var bool
     */
    private bool $generateLog = false;

    /**
     * @var Exception
     */
    private Exception $exception;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @var int
     */
    private int $statusCode, $timeOut = 0;

    /**
     * @var float|null
     */
    private ?float $requestTime;

    /**
     * @return ResponseInterface
     * @throws HttpRequestException
     * @throws LoggerRequestException
     */
    public function buildRequest(): ResponseInterface
    {
        try {
            $client = new Client([
                RequestOptions::TIMEOUT => $this->timeOut,
                RequestOptions::ON_STATS => function (TransferStats $stats) {
                    $this->requestTime = $stats->getTransferTime();
                }
            ]);

            $uri = "{$this->host}{$this->uri}{$this->parameters}";
            $this->response = $client->request(
                $this->method,
                $uri,
                $this->addOptions()
            );
            $this->statusCode = $this->response->getStatusCode();
            return $this->response;
        } catch (GuzzleException | RequestException $e) {
            $this->exception = $e;
            (new RequestBaseCatchException())->checkRequestException($e);
            throw new HttpRequestException(
                (new Config())
                    ->setMessageError("Ocorreu um erro ao tentar realizar uma requisicao externa!")
                    ->setStatusCode($e->getCode())
                    ->setInternalMessageError($e->getMessage())
            );
        } finally {
            $this->generateLog();
        }
    }

    /**
     * @return array
     */
    private function addOptions(): array
    {
        $this->header = [
            "Content-Type" => Header::CONTENT_TYPE_JSON,
            "Authorization" => $this->token
        ];
        return [
            "headers" => $this->header,
            "json" => (empty($this->body) ? null : json_decode($this->body))
        ];
    }

    /**
     * @throws LoggerRequestException
     */
    private function generateLog(): void
    {
        if (!$this->generateLog) {
            return;
        }

        $bodyResponse = (!empty($this->response) ?
            $this->response->getBody()->__toString() : (empty($this->exception) ? "" : $this->exception->getMessage()));

        (new LoggerRequestBuilder())
            ->setUri($this->uri)
            ->setHeader($this->header)
            ->setMethod($this->method)
            ->setRequestTime($this->requestTime)
            ->setBodyRequest($this->body)
            ->setBodyResponse($bodyResponse)
            ->setStatusResponse($this->statusCode ?? $this->exception->getCode())
            ->buildLog()->withParams();
    }

    /**
     * @param string|null $host
     * @return $this
     */
    public function setHost(?string $host): BaseRequestHttpBuilder
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $method
     * @return BaseRequestHttpBuilder
     */
    public function setMethod(string $method): BaseRequestHttpBuilder
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $uri
     * @return BaseRequestHttpBuilder
     */
    public function setUri(string $uri): BaseRequestHttpBuilder
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param string $body
     * @return BaseRequestHttpBuilder
     */
    public function setBody(string $body): BaseRequestHttpBuilder
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $parameters
     * @return BaseRequestHttpBuilder
     */
    public function setParameters(string $parameters): BaseRequestHttpBuilder
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @param string|null $token
     * @return $this
     */
    public function setToken(?string $token): BaseRequestHttpBuilder
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param bool $generateLog
     * @return BaseRequestHttpBuilder
     */
    public function setGenerateLog(bool $generateLog): BaseRequestHttpBuilder
    {
        $this->generateLog = $generateLog;
        return $this;
    }

    /**
     * @param int $timeOut
     * @return BaseRequestHttpBuilder
     */
    public function setTimeOut(int $timeOut): BaseRequestHttpBuilder
    {
        $this->timeOut = $timeOut;
        return $this;
    }
}
