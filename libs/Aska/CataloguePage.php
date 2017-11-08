<?php

namespace Aska;

use Aska\Parser\DomParser;
use Aska\Parser\ParserInterface;
use PHPHtmlParser\Dom;

/**
 * Class CataloguePage
 * @package Aska
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class CataloguePage
{

    /**
     * @var Dom
     */
    private $page;

    /**
     * @var Leaflet[]
     */
    private $items = [];

    /**
     * @var ParserInterface
     */
    private $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->page = $parser->load();
        $this->parser = $parser;
    }

    public function getSource(): string
    {
        return $this->parser->getSource();
    }

    /**
     * @return Leaflet[]
     */
    public function getLeaflets()
    {
        foreach ($this->page->find('.catalogue-item') as $item) {
            $leaflet = new Leaflet($item);
            $leaflet->addLeafletDetail(
                new LeafletDetail(new DomParser(
                    new Dom(), $leaflet->getLeafletDetailUrl()
                ))
            );

            $this->items[] = $leaflet;
        }

        return $this->items;
    }
}
