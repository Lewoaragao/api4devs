<?php

namespace App\Service;

use Exception;
use Illuminate\Http\Response;

class ExceptionService extends Exception
{
    /**
     * Lança uma exceção com uma mensagem e um código de status.
     *
     * @param string $message
     * @param int $statusCode
     * @throws Exception
     */
    public static function exception(string $message, int $statusCode)
    {
        throw new Exception($message, $statusCode);
    }

    /**
     * Lança uma exceção de objeto não encontrado.
     *
     * @throws Exception
     */
    public static function notFound()
    {
        throw new Exception('Object not found', Response::HTTP_NOT_FOUND);
    }

    /**
     * Lança uma exceção de não autorizado para aquele objeto
     *
     * @throws Exception
     */
    public static function unauthorized()
    {
        throw new Exception('No permission for this object', Response::HTTP_UNAUTHORIZED);
    }
}