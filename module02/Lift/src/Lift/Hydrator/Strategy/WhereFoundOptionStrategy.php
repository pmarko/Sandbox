<?php


namespace Lift\Hydrator\Strategy;


use Lift\Repository\WhereFoundOptionRepository;
use Zend\Hydrator\Strategy\StrategyInterface;

class WhereFoundOptionStrategy implements StrategyInterface
{
    /**
     * @var WhereFoundOptionRepository
     */
    private $repository;

    /**
     * WhereFoundOptionStrategy constructor.
     * @param WhereFoundOptionRepository $repository
     */
    public function __construct(WhereFoundOptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @param object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        return $value->getId();
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @param array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        return $this->repository->find($value);
    }
}