<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterProduct;

use DateTime;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Shared\Util\SerializerUtil;
use Registers\Entity\RegisterProduct;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Shared\Exception\DeserializeException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shared\Exception\ObjectValidationException;
use Registers\Exception\RegisterNotExistsException;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterProduct\GetRegisterProductServiceInterface;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceInterface;

class PutRegisterProductMiddleware implements MiddlewareInterface
{
    /**
     * @var SerializerUtil
     */
    private SerializerUtil $serializerUtil;

    /**
     * @var ObjectValidationService
     */
    private ObjectValidationService $objectValidationService;

    /**
     * @var GetRegisterProductServiceInterface
     */
    private GetRegisterProductServiceInterface $getRegisterProductService;

    /**
     * @var GetRegisterCategoryServiceInterface
     */
    private GetRegisterCategoryServiceInterface $getRegisterCategoryService;

    public function __construct(
        SerializerUtil $serializerUtil,
        ObjectValidationService $objectValidationService,
        GetRegisterProductServiceInterface $getRegisterProductService
    ) {
        $this->serializerUtil = $serializerUtil;
        $this->objectValidationService = $objectValidationService;
        $this->getRegisterProductService = $getRegisterProductService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws DeserializeException
     * @throws RegisterCategoryDatabaseException
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     * @throws ObjectValidationException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $productId = intval($request->getAttribute("id_produto"));

        $data = $this->deserialize($request->getBody()->getContents());
        $this->objectValidationService->validateEntity($data);

        $productRegister = $this->getRegisterProductService->getProductById($productId);

        if(!$productRegister) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Produto com o id {$productId} não existe")
            );
        }

        if ($this->getRegisterCategoryService->getCategoryById($data->getIdCategoriaPlanejamento())) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$data->getIdCategoriaPlanejamento()} não existe")
            );
        }

        $data->setIdProduto($productRegister->getIdProduto());
        $data->setIdCategoriaPlanejamento($productRegister->getIdCategoriaPlanejamento());
        $data->setNomeProduto($productRegister->getNomeProduto());
        $data->setValorProduto($productRegister->getValorProduto());
        $data->setDataCadastro(new DateTime());

        return $handler->handle($request->withAttribute('productPut', $data));
    }

    /**
     * @param string $data
     * @return RegisterProduct
     * @throws DeserializeException
     */
    private function deserialize(string $data): RegisterProduct
    {
        return $this->serializerUtil->deserialize($data, RegisterProduct::class);
    }
}
