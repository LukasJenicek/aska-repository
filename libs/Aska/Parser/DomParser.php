<?php

namespace Aska\Parser;

use PHPHtmlParser\Dom;

/**
 * Class DomParser
 * @package Aska\Parser
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class DomParser implements ParserInterface
{
    /**
     * @var Dom
     */
    private $dom;

    /**
     * @var string
     */
    private $url;

    public function __construct(Dom $dom, string $url)
    {
        $this->dom = $dom;
        $this->setUrl($url);
    }

    /**
     * @return Dom
     */
    public function load()
    {
        return $this->dom->loadFromUrl($this->url);
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     */
    private function setUrl(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf("Passed url is in wrong format: %s", $url));
        }

        $this->url = $url;
    }
}
