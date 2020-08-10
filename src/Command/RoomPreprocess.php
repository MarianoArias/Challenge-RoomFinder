<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use App\Mapper\RoomMapper;

use App\Service\RedisCache;
use App\Service\RoomFinder;

class RoomPreprocess extends Command
{
    public function __construct(RedisCache $redisCache, RoomMapper $roomMapper, RoomFinder $roomFinder)
    {
        parent::__construct();
        $this->redisCache = $redisCache;
        $this->roomMapper = $roomMapper;
        $this->roomFinder = $roomFinder;
    }
    
    protected function configure()
    {
        $this
            ->setName('room:preprocess')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("--- room:preprocess - started at " . date("d-m-Y H:i:s") . " ---");

        $rooms = $this->roomFinder->findRooms();
        $rooms = $this->roomMapper->toArrayCollection($rooms);
        $this->redisCache->setObject("rooms", $rooms, RedisCache::TTL_TEN_MINUTES);
                
        $output->writeln("--- room:preprocess - finished at " . date("d-m-Y H:i:s") . " ---");
        
        return 0;
    }
}
