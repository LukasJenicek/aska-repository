<?php

namespace Aska;

use PHPHtmlParser\Dom\AbstractNode;

/**
 * Class CatalogueItem
 * @package Aska
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class Leaflet
{

    /**
     * @var AbstractNode
     */
    private $item;

    /**
     * @var AbstractNode
     */
    private $infoContainer;

    /**
     * @var string
     */
    private $branches;

    /**
     * @var AbstractNode
     */
    private $description;

    /**
     * @var \DateTime | null
     */
    private $start;

    /**
     * @var \DateTime | null
     */
    private $end;

    /**
     * @var LeafletDetail
     */
    private $leafletDetail;

    public function __construct(AbstractNode $node)
    {
        $this->item = $node;
        $this->infoContainer = $this->getInfoContainer();
    }

    public function getTitle(): string
    {
        return $this->getInfoContainer()->find('h2')->text();
    }

    public function getDescription(): string
    {
        if ($this->description === null) {
            $this->description = $this->getInfoContainer()->find('p')->text();
        }

        return $this->description;
    }

    public function getBranches(): string
    {
        if ($this->branches === null) {
            $this->branches = $this->getInfoContainer()->find('p')[1]->text();
        }

        return $this->branches;
    }

    public function getBegin(): ?\DateTime
    {
        $matches = [];

        if (preg_match_all('/\d{2,4}\./', $this->getDescription(), $matches)) {
            // in this format: Expiration date from 02. 11. do 16. 11. 2017.
            // i have found 5 matches because there is no year specified in the first case
            if (count($matches[0]) === 5) {
                $this->start = \DateTime::createFromFormat('d.m.', $matches[0][0] . $matches[0][1]);

            }
        }

        return $this->start;
    }

    public function getEnd(): ?\DateTime
    {
        $matches = [];

        if (preg_match_all('/\d{2,4}\./', $this->getDescription(), $matches)) {
            // in this format: Expiration date from 02. 11. do 16. 11. 2017.
            // i have found 5 matches because there is no year specified in the first case
            if (count($matches[0]) === 5) {
                $this->end = \DateTime::createFromFormat('d.m.Y.', $matches[0][2] . $matches[0][3] . $matches[0][4]);
            }
        }

        return $this->end;
    }

    /**
     * @return string
     */
    public function getLeafletDetailUrl(): string
    {
        $href = $this->getInfoContainer()->find('.catalogue-buttons')->find('a');

        return $href->getAttribute('href');
    }

    /**
     * @param LeafletDetail $detail
     */
    public function addLeafletDetail(LeafletDetail $detail)
    {
        $this->leafletDetail = $detail;
    }

    /**
     * @return LeafletDetail
     */
    public function getLeafletDetail(): LeafletDetail
    {
        return $this->leafletDetail;
    }

    /**
     * @return array|mixed|AbstractNode
     */
    private function getInfoContainer()
    {
        if ($this->infoContainer === null) {
            $this->infoContainer = $this->item->find('.catalogue-info');
        }

        return $this->infoContainer;
    }
}
