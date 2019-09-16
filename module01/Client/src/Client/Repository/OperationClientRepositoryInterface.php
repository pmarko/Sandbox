<?php


namespace Client\Repository;


use Client\Entity\OperationClientEntity;

interface OperationClientRepositoryInterface
{
    public function findOneByOperationAndClient(string $operation, string $client) :?OperationClientEntity;
}