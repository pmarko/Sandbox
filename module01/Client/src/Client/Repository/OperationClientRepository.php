<?php


namespace Client\Repository;


use Client\Entity\OperationClientEntity;

class OperationClientRepository implements OperationClientRepositoryInterface
{
    private $items = [];

    public function __construct()
    {
        $this->items[] = OperationClientEntity::create('OP01', 'rework');
        $this->items[] = OperationClientEntity::create('OP02', 'rework');
        $this->items[] = OperationClientEntity::create('OP03', 'presence-check');
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