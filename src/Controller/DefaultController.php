<?php

namespace App\Controller;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends AbstractController
{

    private $values = [
        "2"=>2, "3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,
        "9"=>9,"10"=>10,"J"=>11,"Q"=>12,"K"=>13,"A"=>14
        ];
    /**
     * @param string $play
     * @return JsonResponse
     */
    public function trickWinnersNT(string $play): JsonResponse
    {
        $cards = explode("-",$play);
        $response = new JsonResponse();
        return $response;
    }

    public function trickWinners(string $play, string $trump):JsonResponse
    {
        $response = new JsonResponse();
        return $response;
    }


}