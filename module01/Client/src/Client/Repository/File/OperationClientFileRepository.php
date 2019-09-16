<?php


namespace Client\Repository\File;

use Client\Entity\OperationClientEntity;
use Client\Repository\OperationClientRepositoryInterface;
use Zend\Config\Config;
use Zend\Config\Reader\Json as JsonReader;
use Zend\Debug\Debug;

class OperationClientFileRepository implements OperationClientRepositoryInterface
{
    private $items = [];

    public function __construct($path)
    {
        $reader = new JsonReader();
        $data = $reader->fromFile($path);
        $this->items = array_map(function($item){
            return OperationClientEntity::createFromConfig(new Config($item));
        }, $data);
    }

    /**
     * @param string $operation
     * @param string $client
     * @return array|null
     */
    public function findOneByOperationAndClient(string $operation, string $client) :?OperationClientEntity
    {
        $matchedItems = array_filter($this->items,
            function (OperationClientEntity $item) use($operation, $client) {
                return ($operation == $item->getOperation() && $client == $item->getClient());
            });

        if(count($matchedItems) === 0) return null;

        return reset($matchedItems);
    }

}