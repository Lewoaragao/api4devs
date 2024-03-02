<?php

namespace App\Service;

use Illuminate\Http\Response;

class MessageService
{
    /**
     * Retorna uma resposta com uma mensagem e um código de status 200.
     *
     * @param string $message
     * @return Response
     */
    public static function ok(string $message)
    {

        return Response(['message' => $message], Response::HTTP_OK);
    }

    public static function destroyOk()
    {

        return Response(['message' => 'Object deleted successfully'], Response::HTTP_OK);
    }
}