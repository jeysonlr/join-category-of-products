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
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shared\Exception\ObjectValidationException;
use Registers\Exception\RegisterNotExistsException;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceInterface;

class PostRegisterProductMiddleware implements MiddlewareInterface
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
     * @var GetRegisterCategoryServiceInterface
     */
    private GetRegisterCategoryServiceInterface $getRegisterCategoryService;

    public function __construct(
        SerializerUtil $serializerUtil,
        ObjectValidationService $objectValidationService,
        GetRegisterCategoryServiceInterface $getRegisterCategoryService
    ) {
        $this->serializerUtil = $serializerUtil;
        $this->objectValidationService = $objectValidationService;
        $this->getRegisterCategoryService = $getRegisterCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws DeserializeException
     * @throws ObjectValidationException
     * @throws RegisterNotExistsException
     * @throws RegisterCategoryDatabaseException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = $this->deserialize($request->getBody()->getContents());
        $this->objectValidationService->validateEntity($data);

        if (!$this->getRegisterCategoryService->getCategoryById($data->getIdCategoriaPlanejamento())) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$data->getIdCategoriaPlanejamento()} não existe")
            );
        }

        $data->setDataCadastro(new DateTime());

        return $handler->handle($request->withAttribute('productPost', $data));
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
