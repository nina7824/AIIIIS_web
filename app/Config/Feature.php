<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Feature extends BaseConfig
{
    /**
     * Enable/disable the auto-routing system.
     * 
     * When true, the router will try to match the URI against 
     * controllers directly without defined routes.
     */
    public bool $autoRoutes = false;

    /**
     * Enable/disable the legacy auto-routing system.
     * 
     * When true, the router will use the legacy auto-routing
     * behavior from CodeIgniter 3.
     */
    public bool $autoRoutesImproved = true;

    /**
     * Enable/disable the strict route matching.
     * 
     * When true, the router will only match routes that exactly
     * match the defined route pattern.
     */
    public bool $strictRoutes = false;

    /**
     * Enable/disable the old filter order.
     * 
     * When true, filters will run in the old order (before globals).
     * When false (default), filters will run after globals.
     */
    public bool $oldFilterOrder = false;
}