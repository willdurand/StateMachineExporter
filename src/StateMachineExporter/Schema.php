<?php

namespace StateMachineExporter;

class Schema
{
    private $xmlSchema;

    public function __construct($filename)
    {
        $this->xmlSchema = file_get_contents($filename);
    }

    public function getDatabase()
    {
        $xmlToAppData = new \XmlToAppData();
        $xmlToAppData->setGeneratorConfig(new GeneratorConfig());

        return $xmlToAppData->parseString($this->xmlSchema)->getDatabase();
    }
}
