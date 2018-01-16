<?php

namespace AvailableBlockchain;


class BlockchainEntity
{
    /**
     * @var array
     */
    protected $poolData;
    /**
     * Only one - when first initial
     * @var string
     */
    protected $previous;
    /**
     * @var array
     */
    protected $parents = [];

    /**
     * @param mixed $data
     * @return $this
     */
    public function addBlock($data)
    {
        $this->poolData[] = $data;
        return $this;
    }
}