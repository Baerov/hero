<?php declare(strict_types=1);

namespace Hero\Skill;

use Hero\Combatant;

class MagicShield implements DefenseSkill{
    public $name = "Magic Shield";
    private $combatant;
    private $chance;

    public function __construct(Combatant $defender, int $chance){
        $this->defender = $defender;
        $this->chance = $chance;
    }

    public function performDefense(){
        if($this->chance == rand(1, 100)){
            $damage = $this->defender->getDefense() / 2;
            print_r($this->defender->getName()." has used ".$this->name.".<br />");
        }

        $damage = $this->defender->getDefense();
        return $damage;
    }
}
?>