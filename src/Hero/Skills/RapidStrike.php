<?php declare(strict_types=1);

namespace Hero\Skill;

use Hero\Combatant;

class RapidStrike implements AttackSkill{
    public $name = "Rapid Strike";
    private $attacker;
    private $chance;

    public function __construct(Combatant $attacker, int $chance){
        $this->attacker = $attacker;
        $this->chance = $chance;
    }

    public function performAttack(){
        if($this->chance == rand(1, 100)){
            $damage = $this->attacker->getStrength() * 2;
            print_r($this->attacker->getName()." has used ".$this->name.".<br />");
        }

        $damage = $this->attacker->getStrength();
        return $damage;
    }
}
?>