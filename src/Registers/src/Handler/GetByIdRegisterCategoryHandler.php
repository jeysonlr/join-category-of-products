<?php

declare(strict_types=1);

namespace Registers\Handler;

use ApiCore\Exception\Config;
use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Exception\RegisterNotExistsException;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceInterface;

class GetByIdRegisterCategoryHandler implements RequestHandlerInterface
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
     * @throws RegisterNotExistsException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $categoryId = intval($request->getAttribute('id_categoria_planejamento'));
        $response = $this->getRegisterCategoryService->getCategoryById($categoryId);

        if (!$response) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$categoryId} não existe")
            );
        }
        return new JsonResponseCore($response, StatusHttp::OK);
    }
}
