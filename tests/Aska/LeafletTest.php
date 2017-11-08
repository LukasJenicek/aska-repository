<?php

namespace Tests\Aska;

use Aska\Leaflet;
use PHPHtmlParser\Dom;
use PHPUnit\Framework\TestCase;

/**
 * Class LeafletTest
 * @package Tests\Aska
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class LeafletTest extends TestCase
{

    private $domStructure = '
        <div class="catalogue-item">
            <div class="catalogue-image">
                <a href="https://www.asko-nabytek.cz/katalog/711p1-cz/" rel="noindex, nofollow" class="katalog" target="_blank">
                    <img src="https://www.asko-nabytek.cz/katalog/711p1-cz/cover.jpg" width="221" height="auto" alt="ASKO - NÁBYTEK Aktuální leták"> 
                </a>
            </div>
            <div class="catalogue-info">
                    <h2>ASKO - NÁBYTEK Aktuální leták</h2>
                    <p><i class="ico-clock"></i>Platnost  od 02. 11. do 16. 11. 2017.</p>
                    <p><i class="ico-home"></i>Platný pro E-shop a pro prodejny Praha - Čakovice, Praha - Štěrboholy, Brno, Plzeň, Teplice, Zlín, Znojmo, Tábor, Chomutov, České Budějovice, Hradec Králové, Mladá Boleslav, Olomouc.</p>
                <div class="catalogue-buttons">
                    <a href="https://www.asko-nabytek.cz/katalog/711p1-cz/" rel="noindex, nofollow" class="button button--outline button--black" target="_blank">Prolistujte si on-line</a>
                </div>
            </div>
        </div>
    ';

    /**
     * @var Dom
     */
    private $dom;

    protected function setUp()
    {
        $this->dom = new Dom();
        $this->dom->loadStr($this->domStructure, []);
    }


    /**
     * @covers \Aska\Leaflet::getBegin()
     */
    public function testGetBegin()
    {
        $item = $this->dom->find('.catalogue-item')[0];

        $leaflet = new Leaflet($item);
        $this->assertInstanceOf(\DateTime::class, $leaflet->getBegin());
    }

    /**
     * @covers \Aska\Leaflet::getEnd()
     */
    public function testGetEnd()
    {
        $item = $this->dom->find('.catalogue-item')[0];

        $leaflet = new Leaflet($item);
        $this->assertInstanceOf(\DateTime::class, $leaflet->getEnd());
    }
}
