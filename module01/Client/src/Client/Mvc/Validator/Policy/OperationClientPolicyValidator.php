<?php


namespace Client\Mvc\Validator\Policy;


use Client\Repository\OperationClientRepository;
use Client\Repository\OperationClientRepositoryInterface;
use Zend\Mvc\Router\RouteMatch;

class OperationClientPolicyValidator
{
    /**
     * @var OperationClientRepositoryInterface
     */
    private $repository;

    /**
     * OperationClientPolicyValidator constructor.
     * @param OperationClientRepositoryInterface $repository
     */
    public function __construct(OperationClientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param RouteMatch $routeMatch
     * @return bool
     */
    public function isValid(RouteMatch $routeMatch) :bool
    {
        $operationName = $routeMatch->getParam('operation', '');
        $clientType = $routeMatch->getParam('client_type', '');

        if(strlen($operationName) == 0 || strlen($clientType) == 0){
            return false;
        }

        $policy = $this->repository->findOneByOperationAndClient($operationName, $clientType);

        if(!$policy){
            return false;
        }

        return $policy->isValid();
    }
}