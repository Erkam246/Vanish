<?php

namespace Erkam246\Vanish;

use pocketmine\scheduler\Task;
use pocketmine\Server;

use function in_array;

class VanishTask extends Task {

    public function onRun(int $currentTick){
        foreach(Server::getInstance()->getOnlinePlayers() as $p){
            if($p->spawned){
                if(in_array($p->getName(), Vanish::$vanish)){
                    foreach(Server::getInstance()->getOnlinePlayers() as $player){
                        $p->hidePlayer($player);
                    }
                }
            }
        }
    }
}