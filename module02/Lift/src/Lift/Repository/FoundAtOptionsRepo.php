<?php


namespace Lift\Repository;


use Zend\Config\Config;
use Zend\Config\Reader\Json as JsonReader;
use Zend\Config\Writer\Json as JsonWriter;
use Zend\Debug\Debug;

class FoundAtOptionsRepo
{
    private $items = [];
    private $filePath = '';
    private $config;

    public function __construct($filePath)
    {
        $data = (new JsonReader())->fromFile($filePath);
        $this->config = new Config($data, true);
        $this->filePath = $filePath;
    }

    public function findAll()
    {
        return $this->config->get('found_at_options', [])->toArray();
    }

    public function getItems()
    {
        return array_map(function($el){
            $obj = new \stdClass();
            $obj->id = $el['id'];
            $obj->label = $el['label'];
            return $obj;
        }, $this->findAll());
    }

    public function setItems($items)
    {
        $data = array_map(function($el){
            return [
                'id' => strlen($el->id) ? $el->id : uniqid(),
                'label' => $el->label
            ];
        }, $items);

        $this->config->found_at_options = $data;

        $this->save();
    }

    private function save()
    {
        $writer = new JsonWriter();
        $writer->toFile($this->filePath, $this->config);
    }
}