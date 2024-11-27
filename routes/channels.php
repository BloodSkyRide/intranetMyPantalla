<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('realtime-channel', function ($user) {
    // Este canal es público, por lo tanto no hay restricciones


    return true;
});