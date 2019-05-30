<?php

namespace App\Twig;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('getAge', [$this, 'getAgeCi']),
            new TwigFilter('ArrayToList', [$this, 'ArrayToList']),
        ];
    }

    public function getAgeCi($ci)
    {
        $year = substr($ci, 0, 2);
        $month = substr($ci, 2, 2);
        $day = substr($ci, 4, 2);


        return DateTime::createFromFormat('y-m-d', "$year-$month-$day")
            ->diff(new DateTime('now'))
            ->y;
    }

    public function ArrayToList(array $array){
        return ucwords(implode(", ", $array));
    }
}