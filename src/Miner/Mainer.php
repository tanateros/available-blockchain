<?php

namespace AvailableBlockchain\Miner;

use AvailableBlockchain\Entity\BlockchainEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class Mainer
 * @package AvailableBlockchain\Miner
 */
class Mainer implements MinerInterface
{
    /** @var EntityManager */
    protected $em;
    /** @var EntityRepository */
    protected $repository;

    /**
     * Mainer constructor.
     * @param EntityRepository $repository
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("AvailableBlockchain\\Entity\\BlockchainEntity");
    }

    public function create(BlockchainEntity $blockchain)
    {
        // TODO need add validate
        var_dump($blockchain);
        $this->em->persist($blockchain);
        $this->em->flush();
    }

    /**
     * @param int $hashId
     * @return null|BlockchainEntity
     */
    public function get($hashId)
    {
        return $this->repository->find($hashId);
    }

    public function isCorrect(BlockchainEntity $blockchain)
    {
        // TODO: Implement isCorrect() method.
    }

    public function remove(BlockchainEntity $blockchain)
    {
        // TODO: Implement remove() method.
    }

    public function save(BlockchainEntity $blockchain)
    {
        throw new \Exception('Remove is not allow.');
    }
}