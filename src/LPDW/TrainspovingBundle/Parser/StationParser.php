<?php

namespace LPDW\TrainspovingBundle\Parser;

use LPDW\TrainspovingBundle\Entity\SNCF\Station;

class StationParser
{
    private $parser;
    private $stack;
 
    public function __construct($encoding = 'UTF-8')
    {
        $this->parser = xml_parser_create($encoding);
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, 'startElement', 'endElement');
        xml_set_character_data_handler($this->parser, 'cdata');

        $this->stack = new \SplStack;
        $this->stack->push('#root');
    }

    public 

    public function parse($data, $callback, $final)
    {
        //return xml_parse($this->parser, $data, $final);
        return xml_parse($this->parser, $data, $final);
        //$callback($station);
    }
 
    public function startElement($parser, $name, array $attributes)
    {
        //echo 'Previous tags: ';
        foreach ($this->stack as $previousName) {
            //echo $previousName . ', ';
        }
        //echo "\n";
 
        $this->stack->push($name);

        //echo 'function start';
        $array = func_get_args();
        //var_dump($array);
        if ($array[1]=='STOPAREA') {
            $name = $array[2]['STOPAREANAME'];
            $externalCode = $array[2]['STOPAREAEXTERNALCODE'];
            //$this->newStation($externalCode, $label);
            $em = $this->getDoctrine()->getEntityManager();
            $station = new Station();
            $station->setName($name);
            $station->setExternalCode($externalCode);
        }

        
    }
 
    public function cdata($parser, $cdata)
    {
        //var_dump(func_get_args());
    }
 
    public function endElement($parser, $name)
    {
        //echo 'function end';
        $this->stack->pop();
        //var_dump(func_get_args());
    }
 
    public function __destruct()
    {
        if (is_resource($this->parser)) {
            xml_parser_free($this->parser);
        }
    }

}