<?php

namespace AvailableBlockchain;
use AvailableBlockchain\Entity\BlockchainEntity;

/**
 * Interface BlockchainInterface
 * @package AvailableBlockchain
 */
interface BlockchainInterface
{
    /**
     * @param BlockchainEntity $blockchain
     * @return $this
     */
    public function setBlockchain(BlockchainEntity $blockchain);

    /**
     * Push to data array
     *
     * @param $data
     * @return $this
     */
    public function push($data);

    /**
     * Merge internal data array.
     * If it has more 1 new data need merge
     *
     * @return $this
     */
    public function merge();

    /**
     * Get data
     *
     * @return array
     */
    public function get();
}