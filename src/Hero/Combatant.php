<?php declare(strict_types=1);

namespace Hero;

use Hero\Skill\AttackSkill;
use Hero\Skill\DefenseSkill;


//General class for any kind of entity in the adventure
//combatant = Any entity that can fight another entity with the same attribute set, but with different values of each attribute, depending on the case
class Combatant{
    //Basic attributes
    private $name;
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;
    private $turns;

    //Dinamic attributes, two categories of skills which will go into an array
    protected $attackSkills = array();
    protected $defenseSkills = array();

    //Basic constructor of the class
    public function __construct($name, $health, $strength, $defence, $speed, $luck, $turns){
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

    public function getName()
    {
        return $this->name;
    }

    public function setHealth($health) {
        $this->health = $health;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function getDefense()
    {
        return $this->defence;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setTurns($turns)
    {
        $this->turns = $turns;
    }

    public function getTurns()
    {
        return $this->turns;
    }

    //Function to check if the combatant has any turns left
    public function hasTurnsLeft(){
        return $this->turns < 20;
    }

    //Function to check if the attack can be avoided with the luck attribute
    public function avoidAttack()
    {
        return $this->luck == rand(1, 100);
    }

    //Function to check if the combatant is still alive
    public function isAlive()
    {
        return $this->health > 0;
    }

    //Function to check if the combatant is defeated in battle, either by having no health, or having no turns left
    public function isDefeated()
    {
        return !$this->isAlive() || !$this->hasTurnsLeft();
    }

    //Function for attacking
    public function attack(Combatant $enemy){
        $this->setTurns($this->getTurns() + 1); //Add one turn to the combatant that is doing the attack
        $damage = 0;

        if (count($this->attackSkills) > 0) {
            foreach ($this->attackSkills as $skill) {
                $damage += $skill->performAttack();
            }
        }

        $damage = $this->getStrength();
        $enemy->defend($damage);
        
        return true;
    }

    //Function for the defending
    public function defend($attack){
        if ($this->avoidAttack()) {
            return;
        }

        $damage = 0;

        if(count($this->defenseSkills) > 0){ //Check if there are any defense skills
            foreach($this->defenseSkills as $skill){
                $damage += $attack - $skill->performDefense(); //if there is one, then add the effect of the skill to the defense value
            }
        }
            
        $damage = $attack - $this->getDefense(); //get the damage value

        if($damage > 0){
            $this->setHealth($this->getHealth() - $damage); //if the damage is bigger than 0, then subscract the damage value from the combatant's health
        }
        return true;
    }

    //Functions for addings new skills for the combatant
    public function addAttackSkill(AttackSkill $skill)
    {
        $this->attackSkills[] = $skill;
    }

    public function addDefenseSkill(DefenseSkill $skill)
    {
        $this->defenseSkills[] = $skill;
    }

    //Function to display all attributes
    public function displayAttributes(){
        print_r("Name: ".$this->getName()." |||| ");
        print_r("Health points: ".$this->getHealth()." |||| ");
        print_r("Strength: ".$this->getStrength()." |||| ");
        print_r("Defense: ".$this->getDefense()." |||| ");
        print_r("Speed: ".$this->getSpeed()." |||| ");
        print_r("Luck: ".$this->getLuck()." |||| ");
    }
}
?>
