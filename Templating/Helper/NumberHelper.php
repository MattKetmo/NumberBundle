<?php

namespace Ketmo\Bundle\NumberBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;

class NumberHelper extends Helper
{
    static $units = array(0, 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
    
    public function formatNumber($number, $decimals = 0)
    {
        return number_format($number, $decimals, '.', ' ');
        // TODO: adapt for english number format
        //return number_format($number, $decimals, '.', ',');
    }
    
    public function convert($number, $unit, $base = 1000)
    {
        $exp = array_search($unit, NumberHelper::$units);
        
        if (false === $exp) {
            throw new \InvalidArgumentException(sprintf('The unit \'%s\' is not supported', $unit));
        }

        return (float) $number / pow($base, $exp);
    }
    
    public function readable($number, $base = 1000)
    {
        $exp = $this->getBestExposant($number, $base);
        $num = $number / pow($base, $exp);
        
        return sprintf('%f %s', $num, NumberHelper::$units[$exp]);
    }
    
    protected function getBestExposant($number, $base = 1000)
    {
        if (!empty($number)) {
            return floor(log($number) / log($base));
        } else {
            return 0;
        }
    }
    
    public function getName()
    {
        return 'number';
    }
}