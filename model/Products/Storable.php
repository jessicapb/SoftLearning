<?php

interface Storable {
    public function getHigh(): float;

    public function getWidth(): float;

    public function getLength(): float;

    public function getWeight(): int;
}
