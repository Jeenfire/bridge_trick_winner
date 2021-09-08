<?php

namespace App\Controller;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{

    private $values = [
        "2"=>2, "3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,
        "9"=>9,"10"=>10,"J"=>11,"Q"=>12,"K"=>13,"A"=>14
    ];
    /**
     * @Route("/tickWinnerNT/{play}", name="trickWinnerNT")
     * @param string $play
     * @return JsonResponse
     */
    public function trickWinnersNT(string $play): JsonResponse
    {
        $response = new JsonResponse();
        $winnerCards = [];
        $tricks = $this->separateTrick($play);
//        var_dump($tricks);
        foreach($tricks as $trick) {
//            var_dump($trick);
            echo implode("-",$trick)." :   ";
            $suitCards = $discardCards = [];
            $suit = $this->setSuit($trick);
            foreach ($trick as $card) {
                $this->isSuit($suit, $card) ? $suitCards[] = $card : $discardCards[] = $card;
            }
            $winner = "";
            if(count($suitCards)==1){$winner = $suitCards[0];}
            elseif(count($suitCards)>1){$winner = $this->compareValues($suitCards);}
                echo $winner."\n";
                array_push($winnerCards,$winner);
        }

        $response->setContent(json_encode([$winnerCards]));
        $response->headers->set('Content-Type', 'application/json');
        var_dump($response->getContent());
            return $response;
        }

    /**
     * @Route("/tickWinner/{play}/{trump}", name="trickWinnerNT")
     * @param string $play
     * @param string $trump
     * @return JsonResponse
     */
        public function trickWinners(string $play, string $trump):JsonResponse
    {
        $response = new JsonResponse();
        $winnerCards = [];
        $tricks = $this->separateTrick($play);
        foreach($tricks as $trick) {
//            var_dump($trick);
            echo implode("-",$trick)." :   ";
            $suitCards = $trumpCards = $discardCards=[];
            $suit = $this->setSuit($trick);
            foreach ($trick as $card) {
                if($this->isTrump($trump, $card)){
                    $trumpCards[] = $card;
                }else{
                    $this->isSuit($suit, $card) ? $suitCards[] = $card : $discardCards[] = $card;
                }
            }
            $winner = "";
            $nbTrump = count($trumpCards);
            $nbSuit = count($suitCards);

            if($nbTrump==1){$winner=$trumpCards[0];}
            elseif($nbTrump>1){$winner = $this->compareValues($trumpCards);}
            elseif($nbSuit==1){$winner = $suitCards[0];}
            elseif($nbSuit>1){$winner = $this->compareValues($suitCards);}
            echo $winner."\n";
            array_push($winnerCards,$winner);
        }
        $response->setContent(json_encode([$winnerCards]));
        $response->headers->set('Content-Type', 'application/json');
        var_dump($response->getContent());
        return $response;
    }

    //Séparation du jeu en différentes levées
        public function separateTrick($play)
    {
        $cards = explode("-",$play);
        $i=0;
        $j=1;
        $tricks = [0=>[],1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[],10=>[],11=>[],12=>[]];
        foreach ($cards as $index=>$card){
            array_push($tricks[$i],$card);
            if($j==4){$j=1; $i++;}
            else{$j++;}
        }
        return $tricks;
    }

    //Définie la couleur de l'entame pour la levée
        public function setSuit($cards)
    {
        $firstCard = $cards[0];
        $firstCardLen = strlen($firstCard);
        return substr($firstCard,$firstCardLen-1,1);
    }

    //Renvoie true si la carte est de la couleur de l'entame false sinon
        public function isSuit($suit,$card)
    {
        return substr($card,-1,1)==$suit;
    }

    //Renvoie true si la carte est un atout false sinon
        public function isTrump($trump,$card)
    {
        return substr($card,-1,1)==$trump;
    }

    //Détermine la carte gagnante d'un groupe de carte
    public function compareValues($cards)
    {
        $maxVal = 0;
        $winner ="";
        foreach ($cards as $card){
            $value = $this->values[substr($card,0,-1)];
            if($value>$maxVal){
                $maxVal = $value;
                $winner = $card;
            }
        }
        return $winner;
    }



    }