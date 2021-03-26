<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterCategory\InsertRegisterCategoryServiceInterface;

class PostRegisterCategoryHandler implements RequestHandlerInterface
{
    /**
     * @var InsertRegisterCategoryServiceInterface
     */
    private InsertRegisterCategoryServiceInterface $insertRegisterCategoryService;

    public function __construct(
        InsertRegisterCategoryServiceInterface $insertRegisterCategoryService
    ) {
        $this->insertRegisterCategoryService = $insertRegisterCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterCategoryDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->insertRegisterCategoryService->insertCategory($request->getAttribute('categoryPost'));
        return new JsonResponseCore($response, StatusHttp::CREATED);
    }
}