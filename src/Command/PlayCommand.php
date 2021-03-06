<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Controller\DefaultController;

class PlayCommand extends Command
{
    /**
     * @var DefaultController
     */
    private $defaultController;

    public function __construct(DefaultController $defaultController)
    {
        $this->defaultController = $defaultController;

        parent::__construct();
    }

    private $cards = [
        "2H","3H","4H","5H","6H","7H","8H","9H","10H","JH","QH","KH","AH",
        "2D","3D","4D","5D","6D","7D","8D","9D","10D","JD","QD","KD","AD",
        "2S","3S","4S","5S","6S","7S","8S","9S","10S","JS","QS","KS","AS",
        "2C","3C","4C","5C","6C","7C","8C","9C","10C","JC","QC","KC","AC"
    ];

    private $values = [
        "2"=>2, "3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,
        "9"=>9,"10"=>10,"J"=>11,"Q"=>12,"K"=>13,"A"=>14
    ];

    protected static $defaultName = "app:play";
    protected static $defaultDescription ="Set a bridge play with random card, with or without trump cards and show the victorious card";

    
    protected function configure():void
    {
        parent::configure(); // TODO: Change the autogenerated stub

        //Paramètre optionnel en cas de partie avec atout
        //Si non renseigné, partie sans atout par défaut
        $this->addOption('trump',"", InputOption::VALUE_REQUIRED,"Is a trick with or whithout trump cards ?",0);
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption("trump") != 0 ? "trump trick" : "no trump trick";
        if($input->getOption("trump") != 0){
            $trump = $this->randomTrump();
            echo "Trick with trump cards : ". $trump."\n";
            echo $this->defaultController->trickWinners($this->randomPlay(),$trump)->getContent();

        }else{
            echo "Trick without trump cards : \n";
            echo $this->defaultController->trickWinnersNT($this->randomPlay())->getContent();
        }

        return Command::SUCCESS;
    }

    //Sélection aléatoire de la couleur d'atout
    /**
     * @throws Exception
     */
    public function randomTrump()
    {
        $families = ["H","D","S","C"];
        return $families[random_int(0, 3)];
    }

    //Fonction créant aléatoirement un jeu
    // symbolisé par une suite de cartes jouées
    /**
     * @throws Exception
     */
    public function randomPlay()
    {
        $cards = $this->cards;
        $selectedCards = "";

        //Ordre aléatoire de l'ensemble du paquet pour former la suite de carte
        for ($i=0; $i<51; $i++){
//            var_dump($cards);
            $randomCard = random_int(0,count($cards)-1);
            $selectedCards .= $i != 0 ? "-".$cards[$randomCard] : $cards[$randomCard];
            array_splice($cards,$randomCard,1);
        }
        //Ajout de la dernière carte restante
        $selectedCards.="-".$cards[0];
        echo "Random play : \n".$selectedCards."\n";
        return $selectedCards;
    }
}