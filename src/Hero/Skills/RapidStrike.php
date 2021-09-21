<?php declare(strict_types=1);

namespace Hero\Skill;

use Hero\Combatant;

class RapidStrike implements AttackSkill
{
    public string $name = "Rapid Strike";
    private Combatant $combatant;
    private int $chance;

    public function __construct(Combatant $combatant, int $chance)
    {
        $this->combatant = $combatant;
        $this->chance = $chance;
    }

    public function performAttack()
    {
        $damage = $this->combatant->getStrength();

        if ($this->chance == rand(1, 100)) {
            $damage = $this->combatant->getStrength() * 2;
            print(sprintf("%s has used %s.<br/>", $this->combatant->getName(), $this->name));
        }
        return $damage;
    }
}