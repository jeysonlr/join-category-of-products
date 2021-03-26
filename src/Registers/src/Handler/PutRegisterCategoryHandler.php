<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterCategory\UpdateRegisterCategoryServiceInterface;

class PutRegisterCategoryHandler implements RequestHandlerInterface
{
    /**
     * @var UpdateRegisterCategoryServiceInterface
     */
    private UpdateRegisterCategoryServiceInterface $updateRegisterCategoryService;

    public function __construct(
        UpdateRegisterCategoryServiceInterface $updateRegisterCategoryService
    ) {
        $this->updateRegisterCategoryService = $updateRegisterCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterCategoryDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->updateRegisterCategoryService->updateCategory($request->getAttribute('categoryPut'));
        return new JsonResponseCore($response, StatusHttp::CREATED);
    }
}
