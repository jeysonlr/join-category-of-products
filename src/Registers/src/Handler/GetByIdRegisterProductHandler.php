<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Exception\Config;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Service\RegisterProduct\GetRegisterProductServiceInterface;

class GetByIdRegisterProductHandler implements RequestHandlerInterface
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
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $productId = intval($request->getAttribute('id_produto'));
        $response = $this->getRegisterProductService->getProductById($productId);

        if (!$response) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$productId} não existe")
            );
        }
        return new JsonResponseCore($response, StatusHttp::OK);
    }
}
