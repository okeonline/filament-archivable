<?php

use Illuminate\Support\Facades\Log;

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'log', Log::class])
    ->each->not->toBeUsed();
