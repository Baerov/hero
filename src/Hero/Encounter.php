<?php declare(strict_types=1);

namespace Hero;

use Hero\Output\CombatOutput;


class Encounter
{

    private Combatant $c1;
    private Combatant $c2;
    private CombatOutput $output;

    public function __construct(Combatant $c1, Combatant $c2)
    {
        $this->c1 = $c1;
        $this->c2 = $c2;
        $this->output = new CombatOutput;
    }

    // Function for the turn-based combat action
    public function combat()
    {
        $swordsString = "&#x2694;";
        $beastString = "&#128023";
        $defeatString = "&#9760;";
        $fightString = "";

        $this->output->displayCondensed(
            print("<h2>Once upon a time there was a great hero, called Orderus, with some strengths and weaknesses, as all heroes have.<br/> 
                   As Orderus walks the ever-green forests of Emagia, he encounters some wild beasts.<br/><br/> 
                   And so... the adventure and fight begins!</h2>"
            )
        );

        // Set up who is the first one to attack
        list($c1, $c2) = self::whoIsFirst($this->c1, $this->c2);

        $this->output->displayCondensed($c1->displayAttributes());
        $this->output->displayCondensed($c2->displayAttributes());

        while (!$c1->isDefeated() && !$c2->isDefeated()) {
            $this->output->displayCondensed(print("<h2>Turn start</h2>"));

            // Display odds depending on both combatants Health Points
            if ($c1->getHealth() > 0 && $c2->getHealth() > 0) {
                $fightString = str_repeat($swordsString, intdiv($c1->getHealth(), 10));
                $fightString .= str_repeat($beastString, intdiv($c2->getHealth(), 10));
            } else {
                $fightString = str_repeat($defeatString, 40);
            }
            $this->output->displayCondensed(print($fightString));

            $c1->attack($c2);
            $this->output->displayCondensed(self::displayTurnInfo($c1, $c2));
            $c2->attack($c1);
            $this->output->displayCondensed(self::displayTurnInfo($c2, $c1));

            $this->output->displayCondensed(print("<h2>Turn end</h2>"));
        }
        if ($c1->isAlive() && $c2->isAlive()) {
            $this->output->displaySpacious(print('<h1>It is a draw!</h1>'));
        } elseif ($c1->isAlive()) {
            $this->output->displaySpacious(print(sprintf("<h1>%s has won the battle!</h1>", $c1->getName())));
        } else {
            $this->output->displaySpacious(print(sprintf("<h1>%s has won the battle!</h1>", $c2->getName())));
        }
    }

    // Function for combat turn output
    protected static function displayTurnInfo(Combatant $attacker, Combatant $defender)
    {
        return print(sprintf("%s attacks %s.", $attacker->getName(), $defender->getName()) .
            PHP_EOL .
            PHP_EOL .
            sprintf("Now %s has %d.", $defender->getName(), $defender->getHealth()));
    }

    protected static function whoIsFirst(Combatant $c1, Combatant $c2): array
    {
        // Initialize the order
        $fightOrder = array($c1, $c2);
        // Check if the speed of both combatants are equal, if it is, then compare their luck and see who is the first
        if ($c1->getSpeed() == $c2->getSpeed()) {
            if ($c1->getLuck() > $c2->getLuck()) {
                $fightOrder = array($c1, $c2);
            } else {
                $fightOrder = array($c2, $c1);
            }
        }
        return $fightOrder;
    }
}