<?php

namespace Ketmo\Bundle\NumberBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;

class NumberHelper extends Helper
{
    static $units = array('k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
    
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

        return (float) $number / pow($base, $exp + 1);
    }
    
    public function readable($number, $base = 1000)
    {
        $exp = $this->getBestExposant($number, $base);
        
        if ($exp == -1) {
            return $number;
        }
        
        $num = (float) $number / pow($base, $exp + 1);
        
        return sprintf('%f %s', $num, NumberHelper::$units[$exp]);
    }
    
    protected function getBestExposant($number, $base = 1000)
    {
        $exp = -1;
        
        while ($number >= $base) {
            $exp++;
            $number /= $base;
        }
        
        return $exp;
    }
    
    public function getName()
    {
        return 'number';
    }
}