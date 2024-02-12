# ObsidianBreakerTNT

ObsidianBreakerTNT is a plugin for PocketMine-MP. The plugin introduces a new mechanic where obsidian blocks can be destroyed by TNT explosions.
The plugin can be handy in servers featuring game modes like Factions.

## Features

- **TNT Explosions**: TNT explosions can now break obsidian blocks.
- **Water Protection**: TNT explosions in water will not break obsidian blocks.
- **Hit Count**: Obsidian blocks will only break after a certain number of TNT explosions. The hit count is configurable.

## Installation

1. Download the latest release from the GitHub repository, or download from the latest [Poggit Release](https://poggit.pmmp.io/p/ObsidianBreakerTNT/)
2. Place the `.phar` file into your server's `plugins` directory.
3. Restart your server so that PocketMine-MP can load the plugin.

## Configuration

You can adjust the hit count (the number of TNT explosions an obsidian block can withstand before breaking) in the `config.yml` file.

## Events

The plugin registers two event listeners:
- `EntityExplodeEvent`: Checks if the exploding entity is a PrimedTNT. If so, the plugin will check the surrounding blocks and add a hit to the directly hitting obsidian(s).
- `BlockBreakEvent`: If an obsidian block is broken by a player, it is removed from the plugin's internal tracking.

## Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the issues page.

## License

This project is GNU licensed.
