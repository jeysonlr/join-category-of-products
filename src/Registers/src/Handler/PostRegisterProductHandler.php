<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Service\RegisterProduct\InsertRegisterProductServiceInterface;

class PostRegisterProductHandler implements RequestHandlerInterface
{
    /**
     * @var InsertRegisterProductServiceInterface
     */
    private InsertRegisterProductServiceInterface $insertRegisterProductService;

    public function __construct(
        InsertRegisterProductServiceInterface $insertRegisterProductService
    ) {
        $this->insertRegisterProductService = $insertRegisterProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterProductDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->insertRegisterProductService->insertProduct($request->getAttribute('product'));
        return new JsonResponseCore($response, StatusHttp::CREATED);
    }
}