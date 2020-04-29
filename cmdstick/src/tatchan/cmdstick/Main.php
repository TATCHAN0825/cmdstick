<?php

declare(strict_types=1);

namespace tatchan\cmdstick;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;
use tatchan\cmdstick\Form\CmdSetForm;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;
use pocketmine\nbt\tag\CompoundTag;
class main extends PluginBase implements Listener
{

    public function onEnable(): void{
        $this->getLogger()->info("§aコマンドステックを起動します");
        $this->getLogger()->info("§amake by tatchan");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "setcmd":
                $sender->sendForm(new CmdSetForm());

                return true;
            default:
                return false;
        }
    }

    public function onTap(PlayerInteractEvent $event)
    {
        $id = $event->getItem()->getId();
        $item = $event->getItem();
        if ($id == "280") {
            $iscmd = "false";
            if (isset($item->getNamedTag()->cmd)) {
                $cmd = $item->getNamedTag()->getString("cmd");
                $this->getServer()->dispatchCommand($event->getPlayer(), "{$cmd}");
            }
        }
    }
}