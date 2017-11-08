<?php
/**
 * Created by PhpStorm.
 * User: lukas-jenicek
 * Date: 8.11.17
 * Time: 12:39
 */

require 'vendor/autoload.php';

$cataloguePage = new \Aska\CataloguePage(new \Aska\Parser\DomParser(
    new \PHPHtmlParser\Dom(), 'http://www.asko-nabytek.cz/katalog-letak-asko'
));

$arrayOutput = new \Aska\Output\ArrayOutput($cataloguePage);
echo '<pre>';
print_r($arrayOutput->output());

