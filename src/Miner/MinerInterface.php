<?php

namespace AvailableBlockchain\Miner;

use AvailableBlockchain\Entity\BlockchainEntity;

/**
 * Interface MinerInterface
 * @package AvailableBlockchain\Miner
 */
interface MinerInterface
{
    /**
     * Create new blockchain
     *
     * @param BlockchainEntity $blockchain
     * @return $this
     */
    public function create(BlockchainEntity $blockchain);

    /**
     * Save data in pull servers blockchain
     *
     * @param BlockchainEntity $blockchain
     * @return $this
     */
    public function save(BlockchainEntity $blockchain);

    /**
     * Is correct internal data array
     *
     * @return bool
     */
    public function isCorrect(BlockchainEntity $blockchain);

    /**
     * Cannot delete this
     *
     * @param $blockchain
     * @return \Exception
     */
    public function remove(BlockchainEntity $blockchain);

    /**
     * Get data
     *
     * @param $hashId int
     * @return BlockchainEntity
     */
    public function get($hashId);
}