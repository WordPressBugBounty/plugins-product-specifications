<?php

declare (strict_types=1);
namespace ProductSpecifications\Vendor\Inpsyde\Modularity\Module;

/**
 * @package Inpsyde\Modularity\Module
 */
interface Module
{
    /**
     * Unique identifier for your Module.
     *
     * @return string
     */
    public function id(): string;
}
