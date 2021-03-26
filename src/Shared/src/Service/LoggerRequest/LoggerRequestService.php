<?php

declare(strict_types=1);

namespace Shared\Service\LoggerRequest;

use Throwable;
use Exception;
use Monolog\Logger;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Shared\Util\FormatterUTF8;
use Shared\DTO\LoggerRequestDTO;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Shared\Exception\LoggerRequestException\LoggerRequestException;

class LoggerRequestService
{
    private const PATH = "/../../../../../data/log/External/";

    private const ERROR_LOGGER_EXCEPTION = "Erro ao gerar arquivo de logs!";

    private const LINE_FORMAT = "%datetime% > %level_name% %message%";

    private const LINE_DATE_FORMAT = "d/m/Y, H:i:s";

    private const REQUEST_FORMAT_SIMPLE = "\n[REQUEST] \nURI: %s \nHEADER: %s \nMETHOD: %s \nREQUEST_TIME: %s \nBODY: %s\n";

    private const RESPONSE_FORMAT_SIMPLE = "\n[RESPONSE] \nSTATUS_CODE: %s \nBODY: %s \n\n\n";

    private const LOGGER_NAME = "Requisicoes Externas";

    /**
     * @var string|null
     */
    private string $uri, $header, $method, $directory, $bodyRequest, $bodyResponse, $logRequest, $logResponse, $fileName;

    /**
     * @var LineFormatter
     */
    private LineFormatter $lineFormatter;

    /**
     * @var float|null
     */
    private float $requestTime;

    /**
     * @var int|null
     */
    private int $statusResponse;

    public function __construct(
        LoggerRequestDTO $loggerRequestDTO
    ) {
        $this->uri = $loggerRequestDTO->getUri();
        $this->header = !empty($loggerRequestDTO->getHeader())
            ? json_encode($loggerRequestDTO->getHeader(), JSON_PRETTY_PRINT)
            : null;
        $this->method = $loggerRequestDTO->getMethod();
        $this->directory = "Price/" . $loggerRequestDTO->getDirectory();
        $this->requestTime = $loggerRequestDTO->getRequestTime();
        $this->bodyRequest = json_encode(
            json_decode($loggerRequestDTO->getBodyRequest()),
            JSON_PRETTY_PRINT
        );
        $this->statusResponse = $loggerRequestDTO->getStatusResponse();
        $this->bodyResponse = FormatterUTF8::isUtf8(
            $loggerRequestDTO->getBodyResponse()
        )
            ? json_encode(json_decode($loggerRequestDTO->getBodyResponse()))
            : json_encode(json_decode($loggerRequestDTO->getBodyResponse()), JSON_PRETTY_PRINT);
        $this->lineFormatter = new LineFormatter(
            self::LINE_FORMAT,
            self::LINE_DATE_FORMAT,
            true
        );
        $this->fileName = date('Y-m-d') . '.log';
    }

    /**
     * @throws Exception
     */
    private function createLog(): void
    {
        $path = $this->createPath();
        $this->checkPath($path);

        $streamHandler = new StreamHandler("{$path}/{$this->fileName}");
        $streamHandler->setFormatter($this->lineFormatter);

        $logger = new Logger(self::LOGGER_NAME);
        $logger->pushHandler($streamHandler);
        $logger->debug("{$this->logRequest}{$this->logResponse}");
    }

    /**
     * @throws LoggerRequestException
     */
    public function withParams(): void
    {
        try {
            $this->logRequest = sprintf(
                self::REQUEST_FORMAT_SIMPLE,
                $this->uri,
                $this->header,
                $this->method,
                $this->requestTime,
                $this->bodyRequest
            );
            $this->logResponse = sprintf(
                self::RESPONSE_FORMAT_SIMPLE,
                $this->statusResponse,
                $this->bodyResponse
            );
            $this->createLog();
        } catch (Throwable $e) {
            throw new LoggerRequestException(
                (new Config())
                    ->setMessageError(self::ERROR_LOGGER_EXCEPTION)
                    ->setStatusCode($e->getCode())
                    ->setInternalMessageError($e->getMessage())
            );
        }
    }

    /**
     * @return string
     */
    private function createPath(): string
    {
        return __DIR__ . self::PATH . "{$this->directory}/";
    }

    /**
     * @param string $path
     * @throws Exception
     */
    private function checkPath(string $path): void
    {
        try {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), StatusHttp::INTERNAL_SERVER_ERROR);
        }
    }
}
