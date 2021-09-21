<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Hero\Combatant;
use Hero\Encounter;

use Hero\Skill\AttackSkill;
use Hero\Skill\DefenseSkill;

final class MainTest extends TestCase
{
    //Combatant mockup
    protected $c1;
    protected $c2;

    public function setUp():void{
        $this->c1 = new Combatant("Orderus", 100, 100, 100, 100, 100, 0);
        $this->c2 = new Combatant("Wild Beast", 90, 90, 90, 90, 90, 0);
    }
    //Basic check if the combatant has the name set
    public function testCombatantName(){
        $this->assertEquals($this->c1->getName(), "Orderus");
        $this->assertEquals($this->c2->getName(), "Wild Beast");

    }

    /**
     * @depends testCombatantName
     */
    //Check if the combat 
    public function testCombat(){
        $attackerPower = $this->c1->getStrength();

        $defenderPower = $this->c2->getDefence();

        $this->assertGreaterThan($defenderPower, $attackerPower);

        $this->assertTrue($this->c1->attack($this->c2));
        $this->assertTrue($this->c2->defend($attackerPower));

    }
}
?>