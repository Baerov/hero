<?php declare(strict_types=1);

namespace Hero\Skill;

use Hero\Combatant;

class MagicShield implements DefenseSkill
{
    public string $name = "Magic Shield";
    private Combatant $combatant;
    private int $chance;

    public function __construct(Combatant $combatant, int $chance)
    {
        $this->combatant = $combatant;
        $this->chance = $chance;
    }

    public function performDefense()
    {
        $damage = $this->combatant->getDefence();

        if ($this->chance == rand(1, 100)) {
            $damage = intdiv($this->combatant->getDefence() , 2);
            print($this->combatant->getName() . " has used " . $this->name . ".<br/>");
        }

        return $damage;
    }
}
