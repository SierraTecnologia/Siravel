<?php

namespace SiObjects\Support\Contracts;

interface Robot{
    public function prepare();
    public function execute();
    public function done();
    public function run();
}