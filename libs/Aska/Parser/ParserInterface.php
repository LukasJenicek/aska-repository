<?php

namespace Aska\Parser;

/**
 * Class ParserInterface
 * @package Aska\Parser
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
interface ParserInterface
{

    /**
     * @return mixed
     */
    public function load();


    /**
     * @return string
     */
    public function getSource(): string;
}
