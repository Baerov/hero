<?php declare(strict_types=1);

namespace Hero\Output;

class CombatOutput implements Output
{
    private string $string = "";

    public function displayCondensed($string = "")
    {
        echo "<br/>" . sprintf("%s", $this->string) . "<br/>";
    }

    public function displaySpacious($string = "")
    {
        echo "<br/>" . "<br/>" . sprintf("%s", $this->string) . "<br/>" . "<br/>";
    }
}