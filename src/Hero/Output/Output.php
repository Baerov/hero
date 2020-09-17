<?php declare(strict_types=1);

namespace Hero\Output;

interface Output{
    public function displayCondensed(string $string);

    public function displaySpacious(string $string);
}

?>