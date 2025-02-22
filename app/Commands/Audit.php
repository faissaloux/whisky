<?php

namespace ProjektGopher\Whisky\Commands;

use LaravelZero\Framework\Commands\Command;
use ProjektGopher\Whisky\Platform;
use ProjektGopher\Whisky\Whisky;

class Audit extends Command
{
    protected $signature = 'audit';

    protected $description = 'Print table with information for diagnostic purposes.';

    public function handle(): int
    {
        // co-pilot things. Might be useful, might not.
        // $this->table(
        //     ['Hook', 'Status', 'File', 'Scripts'],
        //     Hook::all()->map(function (Hook $hook): array {
        //         return [
        //             $hook->name,
        //             $hook->status(),
        //             $hook->file(),
        //             $hook->scripts()->implode(PHP_EOL),
        //         ];
        //     })->toArray()
        // );
        $platform = new Platform();

        $this->table(
            ['key', 'value'],
            [
                ['- Whisky -', ''],
                ['installed globally?', Whisky::isInstalledGlobally() ? 'yes' : 'no'],
                ['running globally?', Whisky::isRunningGlobally() ? 'yes' : 'no'],
                ['dogfooding?', Whisky::dogfooding() ? 'yes' : 'no'],
                ['base path', Whisky::base_path()],
                ['bin path', Whisky::bin_path()],
                // ['readConfig?', Whisky::readConfig()],
                ['- Platform -', ''],
                ['cwd', Platform::cwd()],
                ['getGlobalComposerHome', Platform::getGlobalComposerHome()],
                ['getGlobalComposerBinDir', Platform::getGlobalComposerBinDir()],
                ['isWindows', $platform->isWindows() ? 'yes' : 'no'],
                ['isNotWindows', $platform->isNotWindows() ? 'yes' : 'no'],
                ['gitIsInitialized', $platform->gitIsInitialized() ? 'yes' : 'no'],
                ['gitIsNotInitialized', $platform->gitIsNotInitialized() ? 'yes' : 'no'],
                ['- global -', ''],
                ['base_path', base_path()],
                ['normalized base_path', Platform::normalizePath(base_path())],
            ],
        );

        return Command::SUCCESS;
    }
}
