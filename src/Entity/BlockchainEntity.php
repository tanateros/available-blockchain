<?php

namespace AvailableBlockchain\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class BlockchainEntity
 * @package AvailableBlockchain
 *
 * @ORM\Table(name="blockchain")
 * @ORM\Entity
 */

class BlockchainEntity
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $hashId;
    /**
     * @var string
     * @ORM\Column(name="data", type="string")
     */
    protected $poolData = [];
    /**
     * Only one - when first initial
     * @var string
     * @ORM\Column(name="previous", type="string")
     */
    protected $previous;
    /**
     * @var string
     * @ORM\Column(name="parents", type="string")
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

    /**
     * @return mixed
     */
    public function prepareSave()
    {
        $class = static::class;
        /** @var $this $newBlockchain */
        $newBlockchain = new $class();
        $newBlockchain->previous = $this->hashId;
        $newBlockchain->poolData = implode(';', $this->poolData);
        $newBlockchain->parents = implode(';', $this->parents);
        $newBlockchain->hashId = $this->hashId + 1;

        return $newBlockchain;
    }

    /**
     * @param $blockchain $this
     */
    public function getParentData()
    {
        return $this->previous;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->poolData;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function addParent($parent)
    {
        $this->parents[] = $parent;
        return $this;
    }
}