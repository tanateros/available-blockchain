<?php

namespace AvailableBlockchain;

/**
 * Class Blockchain
 * @package AvailableBlockchain
 */
class Blockchain implements BlockchainInterface
{
    /**
     * @var BlockchainEntity
     */
    protected $blockchain;

    /**
     * Blockchain constructor.
     * @param BlockchainEntity|null $blockchain
     */
    public function __construct(BlockchainEntity $blockchain = null) {
        if (!empty($blockchain)) {
            $this->setBlockchain($blockchain);
        }
    }

    /**
     * @param BlockchainEntity $blockchain
     * @return $this
     */
    public function setBlockchain(BlockchainEntity $blockchain)
    {
        $this->blockchain = $blockchain;
        return $this;
    }

    /**
     * @param mixed $data
     * @return $this
     * @throws \Exception
     */
    public function push($data)
    {
        /**
         * need use exists blockchain or create new after pushing data
         */
        if (empty($this->blockchain)) {
            throw new \Exception('Don\'t set blockchain');
        }

        $this->blockchain->addBlock($data);
        return $this;
    }

    public function __call($name, $arguments)
    {
        throw new \Exception('Method not exists.');
    }

    public function __get($name)
    {
        throw new \Exception("Property {$name} not exists in the class.");
    }
}