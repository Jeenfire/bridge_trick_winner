<?php

namespace App\Controller;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends AbstractController
{

    /**
     * @param string $play
     * @return JsonResponse
     */
    public function trickWinnersNT(string $play): JsonResponse
    {
        $response = new JsonResponse();
        return $response;
    }

    public function trickWinners(string $play, string $trump):JsonResponse
    {
        $response = new JsonResponse();
        return $response;
    }
}