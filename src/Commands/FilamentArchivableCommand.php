<?php

namespace Okeonline\FilamentArchivable\Commands;

use Illuminate\Console\Command;

class FilamentArchivableCommand extends Command
{
    public $signature = 'filament-archivable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
