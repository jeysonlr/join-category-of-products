<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Service\RegisterProduct\UpdateRegisterProductServiceInterface;

class PutRegisterProductHandler implements RequestHandlerInterface
{
    /**
     * @var UpdateRegisterProductServiceInterface
     */
    private UpdateRegisterProductServiceInterface $updateRegisterProductService;

    public function __construct(
        UpdateRegisterProductServiceInterface $updateRegisterProductService
    ) {
        $this->updateRegisterProductService = $updateRegisterProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterProductDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->updateRegisterProductService->updateProduct($request->getAttribute('productPut'));
        return new JsonResponseCore($response, StatusHttp::CREATED);
    }
}
