<?php

namespace Tests\Aska\Parser;

use Aska\Parser\DomParser;
use PHPHtmlParser\Dom;
use PHPUnit\Framework\TestCase;

/**
 * Class DomParserTest
 * @package Tests\Aska\Parser
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class DomParserTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWhenIPassUrlInWrongFormatExceptionShouldBeThrown()
    {
        $dom = $this->getMockBuilder(Dom::class)->getMock();

        $parser = new DomParser($dom, 'www.example');

        $parser = new DomParser($dom, 'www.example.com'); // must be with http / https prefix
    }
}
