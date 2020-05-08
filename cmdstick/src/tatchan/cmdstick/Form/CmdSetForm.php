<?php

namespace tatchan\cmdstick\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
class CmdSetForm implements Form{

    public function handleResponse(Player $player, $data): void {

        if ($data === null) {
            return;
        }

        if($data[0] === "") return;

 
       $item = Item::get(280, 0, 1);
       $item->setLore(["§a{$data[0]}のコマンドを実行できる棒です"]);
               $nbt = $item->getNamedTag();
        $nbt->setString("cmd","{$data[0]}");

        $item->setNamedTag($nbt);
        $enchantment = Enchantment::getEnchantment(1);
        $enchInstance = new EnchantmentInstance($enchantment, 1);
$item->addEnchantment($enchInstance);
$player->getInventory()->addItem($item);
                $player->sendMessage("コマンド棒({$data[0]})を配布しました");
    }

    public function jsonSerialize(){

        return [
            "type" => "custom_form",
            "title" => "コマンドセットフォーム",
            "content" => [
                [
                    "type" => "input",
                    "text" => "セットするコマンドを入力してください",
                    "placeholder" => "ここに記入",
                    "default" => ""
                ]
            ]
        ];
    }
}