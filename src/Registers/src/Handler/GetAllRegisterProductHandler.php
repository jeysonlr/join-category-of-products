<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Service\RegisterProduct\GetRegisterProductServiceInterface;

class GetAllRegisterProductHandler implements RequestHandlerInterface
{
    /**
     * @var GetRegisterProductServiceInterface
     */
    private GetRegisterProductServiceInterface $getRegisterProductService;

    public function __construct(
        GetRegisterProductServiceInterface $getRegisterProductService
    ) {
        $this->getRegisterProductService = $getRegisterProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterProductDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->getRegisterProductService->getAllProducts();
        return new JsonResponseCore(
            $response,
            StatusHttp::OK
        );
    }
}
