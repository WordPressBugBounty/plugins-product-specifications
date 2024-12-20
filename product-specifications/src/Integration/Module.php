<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Integration;

use Amiut\ProductSpecs\Assets\AssetHelper;
use Amiut\ProductSpecs\Integration\WooCommerce\Assets;
use Amiut\ProductSpecs\Integration\WooCommerce\FeaturesCompatibilityDeclarations;
use Amiut\ProductSpecs\Integration\WooCommerce\ProductTabs;
use Amiut\ProductSpecs\Integration\WooCommerce\WooCommerceNotInstalledNoticeHandler;
use Amiut\ProductSpecs\Repository\SpecificationsTableRepository;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Package;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [Assets::class => static fn(ContainerInterface $container) => new Assets($container->get(AssetHelper::class)), WooCommerceNotInstalledNoticeHandler::class => static fn() => new WooCommerceNotInstalledNoticeHandler(), ProductTabs::class => static fn(ContainerInterface $container) => new ProductTabs($container->get(SpecificationsTableRepository::class)), FeaturesCompatibilityDeclarations::class => static fn(ContainerInterface $container) => new FeaturesCompatibilityDeclarations($container->get(Package::PROPERTIES))];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('before_woocommerce_init', $container->get(FeaturesCompatibilityDeclarations::class));
        add_filter('woocommerce_product_tabs', [$container->get(ProductTabs::class), 'addProductSpecificationsTab']);
        add_action('wp_enqueue_scripts', [$container->get(Assets::class), 'load']);
        add_action('admin_init', $container->get(WooCommerceNotInstalledNoticeHandler::class));
        return \true;
    }
}
