<?php

declare(strict_types=1);

namespace Registers\Handler;

use Http\StatusHttp;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Service\RegisterProduct\DeleteRegisterProductServiceInterface;

class DeleteRegisterProductHandler implements RequestHandlerInterface
{
    /**
     * @var DeleteRegisterProductServiceInterface
     */
    private DeleteRegisterProductServiceInterface $deleteRegisterProductService;

    public function __construct(
        DeleteRegisterProductServiceInterface $deleteRegisterProductService
    ) {
        $this->deleteRegisterProductService = $deleteRegisterProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->deleteRegisterProductService->deleteProduct(
            intval($request->getAttribute('id_produto'))
        );
        return new JsonResponseCore('Produto deletado com sucesso!', StatusHttp::OK);
    }
}
