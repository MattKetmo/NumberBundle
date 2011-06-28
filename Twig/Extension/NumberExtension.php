<?php

namespace Ketmo\Bundle\NumberBundle\Twig\Extension;

use Ketmo\Bundle\NumberBundle\Templating\Helper\NumberHelper;

class NumberExtension extends \Twig_Extension
{
    protected $helper;

    public function __construct(NumberHelper $helper)
    {
        $this->helper = $helper;
    }
    
    public function getFilters() {
        return array(
            'number'    => new \Twig_Filter_Method($this, 'number'),
            'convert'   => new \Twig_Filter_Method($this, 'convert'),
            'readable'  => new \Twig_Filter_Method($this, 'readable'),
        );
    }

    public function number($number, $decimals = 0)
    {
        return $this->helper->formatNumber($number, $decimals);
    }
    
    public function convert($number, $multiple, $base = 1000)
    {
        return $this->helper->convert($number, $multiple, $base);
    }
    
    public function readable($number, $base = 1000)
    {
        return $this->helper->readable($number, $base);
    }

    public function getName()
    {
        return 'number';
    }
}
