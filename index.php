<?php
require_once __DIR__.'/vendor/autoload.php';

use \Hero\Combatant;
use \Hero\Encounter;

$output = new \Hero\Output\CombatOutput;

$orderusHero = new Combatant(
    'Orderus',
    rand(70, 100),
    rand(70, 80),
    rand(45, 55),
    rand(40, 50),
    rand(10, 30),
    0
);

$wildBeast = new Combatant(
    'Wild Beast',
    rand(60, 90),
    rand(60, 90),
    rand(40, 60),
    rand(40, 60),
    rand(25, 45),
    0
);

$rapidStrike = new \Hero\Skill\RapidStrike($orderusHero, 10);
$magicShield = new \Hero\Skill\MagicShield($orderusHero, 20);

$orderusHero->addAttackSkill($rapidStrike);
$orderusHero->addDefenseSkill($magicShield);

$battle = new \Hero\Encounter($orderusHero, $wildBeast, $output);

$battle->combat();
?>