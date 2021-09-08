<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PlayCommand extends Command
{
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
        $this->addOption('trump',"", InputOption::VALUE_REQUIRED,"Is a trick with or whithout trump cards ?",0);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption("trump") != 0 ? "trump trick" : "no trump trick";
        echo $type."\n";
        echo $this->randomTrump()."\n";
        var_dump($this->randomTrick());

        return Command::SUCCESS;
    }

    /**
     * @throws Exception
     */
    public function randomTrump()
    {
        $families = ["H","D","S","C"];
        return $families[random_int(0, 3)];
    }

    /**
     * @throws Exception
     */
    public function randomTrick()
    {
        $indexes = [];
        $selectedCards = "";
        for ($i=0; $i<4; $i++){
            $randomCard = random_int(0,51);
            if(!in_array($randomCard,$indexes)){
                $selectedCards .= $i != 0 ? "-".$this->cards[$randomCard] : $this->cards[$randomCard];
                $indexes[]=$randomCard;
            }else{
                $i--;
            }
        }
        return $selectedCards;
    }
}