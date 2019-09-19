<?php


namespace Lift\Adapter\Form\Collection;


class FoundAtOptionsAdapter
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getItems()
    {
        return array_map(function($el){
            $obj = new \stdClass();
            $obj->id = $el['id'];
            $obj->label = $el['label'];
            return $obj;
        }, $this->repository->findAll());
    }

    public function setItems($items)
    {
        // figure what elemens are new
        // will not have id
        $newItems = [];
        foreach ($newItems as $newItem){
            $this->repository->add($newItem);
        }
        // what to delete
        //

    }
}