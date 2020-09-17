<?php declare(strict_types=1);

namespace Hero\Output;

class CombatOutput implements Output{
    private $string;

    public function displayCondensed($string){
        echo "<br/>".$this->string."<br/>";
    }

    public function displaySpacious($string){
        echo "<br/><br/>".$this->string."<br/><br/>";
    }
}

?>