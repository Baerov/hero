<?php declare(strict_types=1); declare(strict_types=1);
namespace Hero;

use \Hero\Output\CombatOutput;


class Encounter{

    private $c1;
    private $c2;
    private $output;

    public function __construct(Combatant $c1, Combatant $c2)
    {
        $this->c1 = $c1;
        $this->c2 = $c2;
        $this->output = new CombatOutput;
    }

    //Function for the turn-based combat action
    public function combat(){

        $this->output->displaySpacious(print("Once upon a time there was a great hero, called Orderus, with some strengths and weaknesses, as all heroes have. <br /> 
        As Orderus walks the ever-green forests of Emagia, he encounters some wild beasts. <br /> <br /> 
        And so... the adventure and fight begins!"));

        //Set up who is the first one to attack
        list($c1, $c2) = self::whoIsFirst($this->c1, $this->c2);

        $this->output->displaySpacious($c1->displayAttributes());
        $this->output->displaySpacious($c2->displayAttributes());
        
        while(!$c1->isDefeated() && !$c2->isDefeated()){
            $this->output->displaySpacious(print("Turn start"));

            $c1->attack($c2);
            $this->output->displayCondensed(self::displayTurnInfo($c1, $c2));
                
            $this->output->displayCondensed(print("-----------"));
                
            $c2->attack($c1);
            $this->output->displayCondensed(self::displayTurnInfo($c2, $c1));

            $this->output->displaySpacious(print("Turn end"));
        }
        if ($c1->isAlive() && $c2->isAlive()) {
            $this->output->displaySpacious(print('<b>It is a draw!</b>'));
        } elseif ($c1->isAlive()) {
            $this->output->displaySpacious(print("<b>".$c1->getName()." has won the battle!</b>"));
        } else {
            $this->output->displaySpacious(print("<b>".$c2->getName()." has won the battle!</b>"));
        }
    }
    //Function for combat turn output
    protected static function displayTurnInfo(Combatant $attacker, Combatant $defender){
        print($attacker->getName()." attacks ".$defender->getName().". ");
        print("Now ".$defender->getName()." has ".$defender->getHealth()." health points.");
    }

    protected static function whoIsFirst(Combatant $c1, Combatant $c2)
    {
        //Initialize the order 
        $fightOrder = array($c1, $c2);
        //Check if the speed of both combatants are equal, if it is, then compare their luck and see who is the first
        if($c1->getSpeed() == $c2->getSpeed()) {
            if ($c1->getLuck() > $c2->getLuck()) {
                $fightOrder = array($c1, $c2);
            }else{
                $fightOrder = array($c2, $c1);
            } 
        }
        return $fightOrder;
    }
}
?>