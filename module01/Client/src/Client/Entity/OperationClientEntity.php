<?php


namespace Client\Entity;


use Zend\Config\Config;

class OperationClientEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $operation;

    /**
     * @var string
     */
    private $client;

    /**
     * @var \DateTimeInterface
     */
    private $deleted;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     * @return OperationClientEntity
     */
    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     * @return OperationClientEntity
     */
    public function setClient(string $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    /**
     * @param \DateTimeInterface $deleted
     * @return OperationClientEntity
     */
    public function setDeleted(\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid() :bool
    {
        return ($this->getDeleted() === null);
    }

    /**
     * @param $operation
     * @param $client
     * @return OperationClientEntity
     */
    public static function create($operation, $client)
    {
        $self = new self();
        $self->setClient($client);
        $self->setOperation($operation);
        return $self;
    }

    /**
     * @param Config $config
     * @return OperationClientEntity
     */
    public static function createFromConfig(Config $config)
    {
        $self = new self();
        $self->setClient($config->get('client', ''));
        $self->setOperation($config->get('operation', ''));
        return $self;
    }
}