<?php

declare(strict_types=1);

namespace minijaham\ObsidianBreakerTNT;

use pocketmine\block\Opaque;
use pocketmine\world\Position;

final class ObsidianData
{
    /**
     * ObsidianData Constructor.
     *
     * @param Opaque $obsidian
     * @param int $count
     *
     */
    public function __construct(
        private Opaque $obsidian,
        private int $count = 1
        private $block;
    ){}

    public function getBlock() : Opaque
    {
        return $this->obsidian;
    }

    public function getPosition() : Position
    {
        return $this->block->getPosition();
    }

    public function getCount() : int
    {
        return $this->count;
    }

    public function addCount(int $count = 1) : void
    {
        $this->count += $count;
    }
}
