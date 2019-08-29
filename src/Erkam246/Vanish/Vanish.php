<?php

namespace Erkam246\Vanish;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use function array_search;
use function in_array;
use function strtolower;

class Vanish extends PluginBase {
    public const PREFIX = "§9Vanish §8» §r";

    public static $vanish = [];

    protected static $main;

    public function onEnable(){
        self::$main = $this;
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new VanishTask(), 20);
    }

    public static function getMain(): self{
        return self::$main;
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        $name = $sender->getName();
        if(strtolower($cmd->getName()) === "vanish"){
            if(!$sender instanceof Player){
                return false;
            }
            if(!$sender->hasPermission("vanish.use")){
                return false;
            }
            if(!in_array($name, self::$vanish)){
                self::$vanish[] = $name;
                $sender->sendMessage(self::PREFIX."§aYou are now vanished.");
            }else{
                unset(self::$vanish[array_search($name, self::$vanish)]);
                foreach($this->getServer()->getOnlinePlayers() as $players){
                    $players->showPlayer($sender);
                }
                $sender->sendMessage(self::PREFIX."§cYou are no longer vanished!");
            }
        }
        return true;
    }
}