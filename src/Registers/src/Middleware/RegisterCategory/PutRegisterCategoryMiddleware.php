<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterCategory;

use Http\StatusHttp;
use ApiCore\Exception\Config;
use Shared\Util\SerializerUtil;
use Registers\Entity\RegisterCategory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Shared\Exception\DeserializeException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shared\Exception\ObjectValidationException;
use Registers\Exception\RegisterNotExistsException;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceInterface;

class PutRegisterCategoryMiddleware implements MiddlewareInterface
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
     * @throws RegisterCategoryDatabaseException
     * @throws RegisterNotExistsException
     * @throws ObjectValidationException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $categoryId = intval($request->getAttribute("id_categoria_planejamento"));

        $data = $this->deserialize($request->getBody()->getContents());
        $this->objectValidationService->validateEntity($data);

        $categoryRegister = $this->getRegisterCategoryService->getCategoryById($categoryId);

        if(!$categoryRegister) {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$categoryId} não existe")
            );
        }
        $data->setIdCategoriaPlanejamento($categoryId);
        $data->setNomeCategoria($data->getNomeCategoria());

        return $handler->handle($request->withAttribute('categoryPut', $data));
    }

    /**
     * @param string $data
     * @return RegisterCategory
     * @throws DeserializeException
     */
    private function deserialize(string $data): RegisterCategory
    {
        return $this->serializerUtil->deserialize($data, RegisterCategory::class);
    }
}
