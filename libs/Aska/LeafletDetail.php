<?php

namespace Aska;

use Aska\Parser\ParserInterface;

/**
 * Class LeafletDetail
 * @package Aska
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class LeafletDetail
{

    private $page;

    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * LeafletDetail constructor.
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->page = $parser->load();
        $this->parser = $parser;
    }

    /**
     * @return string
     */
    public function getPDFSource(): string
    {
        $source = $this->parser->getSource() . $this->page->find('#ecpaper-controls')->find('a')[4]->getAttribute('href');

        return $source;
    }
}
