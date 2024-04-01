<?php

declare(strict_types=1);

namespace minijaham\ObsidianBreakerTNT;

use pocketmine\block\Opaque;
use pocketmine\world\Position;

final class ObsidianData
{
    private Position $block; // Declare the $block property

    /**
     * ObsidianData Constructor.
     *
     * @param Opaque $obsidian
     * @param int $count
     * @param Position $block
     *
     */
    public function __construct(
    private Opaque $obsidian,
    Position $block, // Move $block before $count
    private int $count = 1 // Now $count is after all required parameters
){
    $this->block = $block; // Initialize $block in the constructor
}

    public function getBlock() : Opaque
    {
        return $this->obsidian;
    }

    public function getPosition() : Position
    {
        return $this->block; // Now you can access $block
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
