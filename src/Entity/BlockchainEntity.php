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
     * @var string|array
     * @ORM\Column(name="data", type="string")
     */
    protected $data;

    static $poolData = [];
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
    protected $parents;

    static $parentsData = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->hashId;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function addBlock($data)
    {
        static::$poolData[] = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function prepareSave($id = null)
    {
        $class = static::class;
        /** @var $this $newBlockchain */
        $newBlockchain = new $class();
        $newBlockchain->previous = $id;
        foreach (static::$poolData as $item) {
            if (is_array($item)) {
                $newBlockchain->data .= json_encode($item);
            } else {
                $newBlockchain->data .= $item;
            }
        }
        $newBlockchain->parents = implode(';', static::$parentsData);
        $newBlockchain->hashId = $this->hashId + 1;

        return $newBlockchain;
    }

    /**
     * @return array
     */
    public function getParents()
    {
        return static::$parentsData;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return static::$poolData;
    }

    /**
     * @return string
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function addParent($parent)
    {
        static::$parentsData[] = $parent;
        return $this;
    }
}