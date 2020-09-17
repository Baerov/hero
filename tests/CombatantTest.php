<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Hero\Combatant;
use Hero\Encounter;

final class CombatantTest extends TestCase
{
    protected $combatant1Test;
    protected $combatant2Test;

    public function setUp():void{
        $this->combatant1Test = new Combatant("Orderus", 100, 100, 100, 100, 100, 0);
        $this->combatant2Test = new Combatant("Wild Beast", 100, 100, 100, 100, 100, 0);
    }

    public function testHasName(){
        $this->assertEquals($this->combatant1Test->getName(), "Orderus");
        $this->assertEquals($this->combatant2Test->getName(), "Wild Beast");
    }

    public function testCanAttack(){
        
    }


}
?>