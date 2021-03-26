<?php

declare(strict_types=1);

namespace Shared\Util;

use ApiCore\Exception\Config;
use Http\StatusHttp;
use JMS\Serializer\Serializer;
use Shared\Exception\DeserializeException;
use Shared\Exception\SerializeException;
use Exception;

class SerializerUtil
{
    const DEFAULTTYPE = 'json';
    const MESSAGEERROR = 'Ocorreu um erro ao processar sua solicitação, entre em contato com o suporte';
    const INTERNALMESSAGEERROR = 'Não foi possível reconhecer os dados informados no corpo da requisição';

    /**
     * @var Serializer
     */
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $body
     * @param $type
     * @param null $context
     * @return string
     * @throws SerializeException
     */
    public function serialize($body, $type = self::DEFAULTTYPE, $context = null): ?string
    {
        try {
            return $this->serializer->serialize($body, $type, $context);
        } catch (Exception $e) {
            throw new SerializeException(
                (new Config())
                ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                ->setMessageError('Ocorreu um erro ao serializar dados')
            );
        }
    }

    /**
     * @param string $body
     * @param string $class
     * @param string $type
     * @return mixed
     * @throws DeserializeException
     */
    public function deserialize(string $body, string $class, string $type = self::DEFAULTTYPE)
    {
        try {
            return $this->serializer->deserialize($body, $class, $type);
        } catch (Exception $e) {
            throw new DeserializeException(
                (new Config())
                    ->setStatusCode(StatusHttp::UNPROCESSABLE_ENTITY)
                    ->setMessageError(self::INTERNALMESSAGEERROR)
                    ->setInternalMessageError(self::INTERNALMESSAGEERROR)
            );
        }
    }
}
