<?php declare(strict_types=1);

namespace Hero;

use Hero\Skill\AttackSkill;
use Hero\Skill\DefenseSkill;


//General class for any kind of entity in the adventure
//combatant = Any entity that can fight another entity with the same attribute set, but with different values of each attribute, depending on the case
class Combatant
{
    //Basic attributes
    private string $name;
    private int $health;
    private int $strength;
    private int $defence;
    private int $speed;
    private int $luck;
    private int $turns;

    //Dynamic attributes, two categories of skills which will go into an array
    protected array $attackSkills = [];
    protected array $defenseSkills = [];

    //Basic constructor of the class
    public function __construct($name, $health, $strength, $defence, $speed, $luck, $turns)
    {
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->turns = $turns;
    }

    //Basic getter and setter functions
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }

    public function setTurns($turns)
    {
        $this->turns = $turns;
    }

    public function getTurns(): int
    {
        return $this->turns;
    }

    //Function to check if the combatant has any turns left
    public function hasTurnsLeft(): bool
    {
        return $this->turns < 20;
    }

    //Function to check if the attack can be avoided with the luck attribute
    public function avoidAttack(): bool
    {
        return $this->luck == rand(1, 100);
    }

    //Function to check if the combatant is still alive
    public function isAlive(): bool
    {
        return $this->health > 0;
    }

    //Function to check if the combatant is defeated in battle, either by having no health, or having no turns left
    public function isDefeated(): bool
    {
        return !$this->isAlive() || !$this->hasTurnsLeft();
    }

    //Function for attacking
    public function attack(Combatant $enemy): bool
    {
        $this->setTurns($this->getTurns() + 1); //Add one turn to the combatant that is doing the attack
        $damage = 0;

        if (count($this->attackSkills) > 0) {
            foreach ($this->attackSkills as $skill) {
                $damage += $skill->performAttack();
            }
        } else {
            $damage = $this->getStrength();
        }

        $enemy->defend($damage);

        return true;
    }

    //Function for the defending
    public function defend($attack): ?bool
    {
        if ($this->avoidAttack()) {
            return null;
        }

        $damage = 0;

        if (count($this->defenseSkills) > 0) { //Check if there are any defense skills
            foreach ($this->defenseSkills as $skill) {
                $damage += $attack - $skill->performDefense(); //if there is one, then add the effect of the skill to the defense value
            }
        } else {
            $damage = $attack - $this->getDefence(); //get the damage value
        }


        if ($damage > 0) {
            $this->setHealth($this->getHealth() - $damage); //if the damage is bigger than 0, then subscript the damage value from the combatant's health
        }
        return true;
    }

    //Functions for adding new skills for the combatant
    public function addAttackSkill(AttackSkill $skill)
    {
        $this->attackSkills[] = $skill;
    }

    public function addDefenseSkill(DefenseSkill $skill)
    {
        $this->defenseSkills[] = $skill;
    }

    //Function to display all attributes
    public function displayAttributes(): int
    {
        return print(sprintf("<h2>Name: %s <br/>Health Points: %s <br/>Strength: %s <br/>Defence: %s <br/>Speed: %s <br/>Luck: %s</h2>",
            $this->getName(),
            $this->getHealth(),
            $this->getStrength(),
            $this->getDefence(),
            $this->getSpeed(),
            $this->getLuck()));
    }
}
