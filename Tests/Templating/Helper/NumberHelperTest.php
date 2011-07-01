<?php

namespace Ketmo\Bundle\NumberBundle\Templating\Helper;

class NumberHelperTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;
    
    public function setUp()
    {
        $this->helper = new NumberHelper();
    }
    
    public function testConvert()
    {
        $this->assertEquals($this->helper->convert(123456789, 'k', 1000), 123456.789);
        $this->assertEquals($this->helper->convert(123456789, 'M', 1000), 123.456789);
        $this->assertEquals($this->helper->convert(123456789, 'k', 1024), 120563.2705);
        $this->assertEquals($this->helper->convert(123456789, 'M', 1024), 117.7375689);
    }
    
    public function testReadable()
    {
        $this->assertEquals($this->helper->convert(123456789, 1000), 123.456789);
    }
    
    protected function testGetBestExposant()
    {
        $this->assertEquals($this->helper->convert(123456789, 1000), 1);
    }   
}