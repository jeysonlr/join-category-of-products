<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterCategory;

use Shared\Util\SerializerUtil;
use Registers\Entity\RegisterCategory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Shared\Exception\DeserializeException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shared\Exception\ObjectValidationException;
use Shared\Service\Validation\ObjectValidationService;

class PostRegisterCategoryMiddleware implements MiddlewareInterface
{
    /**
     * @var SerializerUtil
     */
    private SerializerUtil $serializerUtil;

    /**
     * @var ObjectValidationService
     */
    private ObjectValidationService $objectValidationService;

    public function __construct(
        SerializerUtil $serializerUtil,
        ObjectValidationService $objectValidationService
    ) {
        $this->serializerUtil = $serializerUtil;
        $this->objectValidationService = $objectValidationService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws DeserializeException
     * @throws ObjectValidationException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = $this->deserialize($request->getBody()->getContents());
        $this->objectValidationService->validateEntity($data);

        return $handler->handle($request->withAttribute('categoryPost', $data));
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
