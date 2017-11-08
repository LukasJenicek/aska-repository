<?php

namespace Aska\Output;

use Aska\CataloguePage;

/**
 * Class ArrayOutput
 * @package Aska\Output
 * @author: Lukas Jenicek <lukas.jenicek5@gmail.com>
 */
class ArrayOutput implements OutputInterface
{

    /**
     * @var CataloguePage
     */
    private $page;

    public function __construct(CataloguePage $page)
    {
        $this->page = $page;
    }


    /**
     * @return array
     */
    public function output(): array
    {
        $data = [];
        foreach ($this->page->getLeaflets() as $leaflet) {
            $begin = $leaflet->getBegin();
            $end = $leaflet->getEnd();

            $data[] = [
                'title' => $leaflet->getTitle(),
                'description' => $leaflet->getDescription() . " ". $leaflet->getBranches(),
                'begin' => $begin !== null ? $begin->format('Y-m-d 00:00:00') : 'N/A',
                'end' => $end !== null ? $end->format('Y-m-d 23:59:59') : 'N/A',
                'source_url' => $this->page->getSource(),
                'file_orig' => $leaflet->getLeafletDetail()->getPDFSource()
            ];
        }

        return $data;
    }
}
