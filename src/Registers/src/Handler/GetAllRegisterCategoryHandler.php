<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceInterface;

class GetAllRegisterCategoryHandler implements RequestHandlerInterface
{
    /**
     * @var GetRegisterCategoryServiceInterface
     */
    private GetRegisterCategoryServiceInterface $getRegisterCategoryService;

    public function __construct(
        GetRegisterCategoryServiceInterface $getRegisterCategoryService
    ) {
        $this->getRegisterCategoryService = $getRegisterCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterCategoryDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->getRegisterCategoryService->getAllCategorys();
        return new JsonResponseCore(
            $response,
            StatusHttp::OK
        );
    }
}
