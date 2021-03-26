<?php

declare(strict_types=1);

namespace Infrastructure\Middleware;

use Throwable;
use Http\StatusHttp;
use Shared\Util\ApiMessages;
use ApiCore\Exception\ExceptionCore;
use ApiCore\Response\JsonResponseCore;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shared\Exception\Common\DatabaseException;
use Shared\Exception\Common\InvalidValueException;
use Shared\Exception\Common\InternalErrorException;
use Shared\Exception\Common\RequestExternalException;
use Shared\Exception\Common\UnauthorizedActionException;
use Shared\Exception\Common\ValueAlreadyExistsException;
use Shared\Exception\Common\ValueNotExistsOrNotFoundException;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (DatabaseException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (RequestExternalException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (InternalErrorException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (InvalidValueException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (UnauthorizedActionException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (ValueAlreadyExistsException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (ValueNotExistsOrNotFoundException $e) {
            return new JsonResponseCore($e->getCustomError(), $e->getCode());
        } catch (ExceptionCore $e) {
            return new JsonResponseCore(ApiMessages::DEFAULTEXCEPTIONMESSAGE, StatusHttp::INTERNAL_SERVER_ERROR);
        } catch (Throwable $e) {
            return new JsonResponseCore(ApiMessages::DEFAULTEXCEPTIONMESSAGE, StatusHttp::INTERNAL_SERVER_ERROR);
        }
    }
}
