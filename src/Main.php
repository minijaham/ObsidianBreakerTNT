<?php

declare(strict_types=1);

namespace minijaham\ObsidianBreakerTNT;

use pocketmine\plugin\PluginBase;

use pocketmine\block\Water;
use pocketmine\block\VanillaBlocks;

use pocketmine\entity\object\PrimedTNT;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\block\BlockBreakEvent;

class Main extends PluginBase implements Listener
{
    /** @var ObsidianData[] */
    private array $obsidian = [];

    public function onEnable() : void
    {
        $this->saveDefaultConfig();

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onEntityExplode(EntityExplodeEvent $event) : void
    {
        $entity = $event->getEntity();

        if ($entity instanceof PrimedTNT) {
            $pos    = $entity->getPosition();
            $center = $entity->getWorld()->getBlockAt(
                $pos->getFloorX(),
                $pos->getFloorY(),
                $pos->getFloorZ()
            );

            // Cancel TNT Explosion in water
            if ($center instanceof Water) {
                return;
            }

            $affected = [];

            // Get blocks from all side of the PrimedTNT
            for ($i = 0; $i <= 6; $i++) {
                $affected[] = $center->getSide($i);
            }

            foreach ($affected as $block) {
                // If block isn't obsidian
                if(!$block instanceof (VanillaBlocks::OBSIDIAN())) {
                    continue;
                }

                // If ObsidianData already exists, then add count if it does.
                $found = false;
                foreach ($this->obsidian as $obsidianData) {
                    if ($obsidianData->getPosition()->equals($block->getPosition())) {
                        $obsidianData->addCount();
                        $found = true;
                    }
                }

                // If ObsidianData doesn't exist, create a new one
                if (!$found) {
                    $this->obsidian[] = new ObsidianData($block);
                }

                $this->obsidian = array_filter($this->obsidian, function ($object) {
                    if($object->getCount() >= $this->getConfig()->getNested("hit-count")) {
                        $object->getPosition()->getWorld()->setBlockAt(
                            $object->getPosition()->getFloorX(),
                            $object->getPosition()->getFloorY(),
                            $object->getPosition()->getFloorZ(),
                            VanillaBlocks::AIR()
                        );
                        return false; // returning false will remove the ObsidianData from the array
                    }
                    return true;
                });
            }
        }
    }

    /**
     * Remove ObsidianData if the obsidian is broken by hand
     */
    public function onBlockBreak(BlockBreakEvent $event) : void
    {
        $block = $event->getBlock();

        $this->obsidian = array_filter($this->obsidian, (function ($object) use ($block) {
            if($object->getPosition()->equals($block->getPosition())) {
                return false; // returning false will remove the ObsidianData from the array
            }
            return true;
        }));
    }
}
