<?php


namespace Lift\Repository;


trait FlushableTrait
{
    /**
     * @return $this
     */
    public function flush()
    {
        $this->objectManager->flush();
        return $this;
    }
}