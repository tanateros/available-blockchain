<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__ . "/src/Entity/");
/*
 * Need run code in console:
 * php vendor/bin/doctrine orm:schema-tool:create
 */
$isDevMode = false;

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'test_my_db',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$em = EntityManager::create($dbParams, $config);

$bc1 = new AvailableBlockchain\Entity\BlockchainEntity();
$bc1->addBlock('{"text": "first data"}');
$prepareBc1 = $bc1->prepareSave();

$bc2 = new AvailableBlockchain\Entity\BlockchainEntity();
$bc2->addBlock('{"text": "second data"}');
$prepareBc2 = $bc2->prepareSave();

$miner = new AvailableBlockchain\Miner\Mainer($em);
$bc1Id = $miner->create($prepareBc1);
$bc2Id = $miner->create($prepareBc2);

$mainBc1 = $miner->get($bc1Id);
$mainBc2 = $miner->get($bc2Id);

$mainBc1->addBlock($mainBc1->getData());
$mainBc1->addParent($mainBc1->getId());
$mainBc1->addBlock($mainBc2->getData());
$mainBc1->addParent($mainBc2->getId());

$prepareNewBc1 = $bc1->prepareSave($mainBc1->getId());
$miner->save($prepareNewBc1);