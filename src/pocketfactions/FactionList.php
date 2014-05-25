<?php

namespace pocketfactions;

use pocketfactions\faction\Faction;
use pocketfactions\tasks\ReadDatabaseTask;
use pocketfactions\tasks\WriteDatabaseTask;

use pocketmine\utils\Binary as Bin;

class FactionList{
	const MAGIC_P = "\0xfa\0xc7\0x10\0x25"; // leet for factions
	const MAGIC_S = "\0xde\0xad\0xc0\0xde"; // leet for deadcode
	public $factions = false;
	private $main, $path;
	public function __construct($path){
		$this->main = Main::get();
		$this->path = $path;
		$this->load();
	}
	public function __destruct(){
		$this->save();
	}
	public function addFaction($args){
		if($this->factions === false){
			return false;
		}
		$this->factions[] = new Faction($this->nextID());
	}
    public function rmFaction($args){
        //remove a faction
    }
    public function usrFaction($name){
        //get user info
    }
    public function usrFactionPerm($name){
        //get user rank
    }
    public function invFaction(Player $p){
        //invite target player in a faction
    }
    public function existFaction($name){
        //checks if faction exist or not
    }
    public function joinFaction($args){
        //join a faction
    }
	public function nextID(){
		$fid = $this->main->getConfig()->get("next-fid");
		$this->main->getConfig()->set("next-fid", $fid + 1);
		$this->main->getConfig()->save();
		return $fid;
	}
	public function load(){
		$res = fopen($this->path, "rb");
		$this->loadFrom($res);
	}
	public function loadFrom($res){
		Server::getInstance()->getScheduler()->scheduleAsyncTask(new ReadDatabaseTask($res), array($this, "onLoaded"));
	}
	public function onLoaded(array $factions){
		$this->factions = $factions;
	}
	public function save(){
		$res = fopen($this->path, "wb");
		$this->saveTo($res);
	}
	public function saveTo($res){
		Server::getInstance()->getScheduler()->scheduleAsyncTask(new WriteDatabaseTask($res));
	}
}
