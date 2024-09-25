<?php

interface Marketable {
    public function getPrice(): float;
    public function getDescription(): string;
    public function getCode(): int;
}
