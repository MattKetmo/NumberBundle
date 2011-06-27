<?php

namespace Ketmo\Bundle\NumberBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;

class NumberHelper extends Helper
{
    public function formatNumber($number, $decimals = 0)
    {
        return number_format($number, $decimals, ',', ' ');
        // TODO: adapt for english number format
        //return number_format($number, $decimals, '.', ',');
    }
    
    public function convert($number, $unit, $base = 1000)
    {
        static $units = array('K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
        $exp = array_search($unit, $units);
        
        if (false === $exp) {
            throw new \InvalidArgumentException(sprintf('The unit \'%s\' is not supported', $unit));
        }

        return (float) $number / pow($base, $exp + 1);
    }
    
    public function getName()
    {
        return 'number';
    }
}