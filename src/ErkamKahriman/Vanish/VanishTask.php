<?php

namespace ErkamKahriman\Vanish;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class VanishTask extends Task {

    public function onRun(int $currentTick) {
        foreach (Server::getInstance()->getOnlinePlayers() as $player){
            if($player->spawned){
                if(Vanish::getInstance()->vanish[$player->getName()] == true){
                    foreach(Server::getInstance()->getOnlinePlayers() as $players){
                        $players->hidePlayer($player);
                    }
                }
            }
        }
    }
}