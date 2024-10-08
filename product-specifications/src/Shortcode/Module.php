<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Shortcode;

use Amiut\ProductSpecs\Repository\SpecificationsTableRepository;
use Amiut\ProductSpecs\Template\TemplateRenderer;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Shortcode\SpecificationsTable::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Shortcode\SpecificationsTable($container->get(TemplateRenderer::class), $container->get(SpecificationsTableRepository::class))];
    }
    public function run(ContainerInterface $container): bool
    {
        $tableShortcode = $container->get(\Amiut\ProductSpecs\Shortcode\SpecificationsTable::class);
        add_action('init', static function () use ($tableShortcode) {
            add_shortcode(\Amiut\ProductSpecs\Shortcode\SpecificationsTable::KEY, [$tableShortcode, 'render']);
        });
        return \true;
    }
}
