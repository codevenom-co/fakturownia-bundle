<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class CodevenomFakturowniaExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('codevenom_fakturownia.base_url', $config['base_url'] ?? '%env(default:fakturownia_base_url_default:FAKTUROWNIA_BASE_URL)%');
        $container->setParameter('codevenom_fakturownia.api_token', $config['api_token'] ?? '%env(default:fakturownia_api_token_default:FAKTUROWNIA_API_TOKEN)%');
        $container->setParameter('codevenom_fakturownia.seller_name', $config['seller_name'] ?? '%env(default:fakturownia_seller_name_default:FAKTUROWNIA_SELLER_NAME)%');
        $container->setParameter('codevenom_fakturownia.seller_tax_id', $config['seller_tax_id'] ?? '%env(default:fakturownia_seller_tax_id_default:FAKTUROWNIA_SELLER_TAX_ID)%');

        $container->setParameter('fakturownia_base_url_default', 'https://app.fakturownia.pl');
        $container->setParameter('fakturownia_api_token_default', '');
        $container->setParameter('fakturownia_seller_name_default', '');
        $container->setParameter('fakturownia_seller_tax_id_default', '');

        $container->setParameter('codevenom_fakturownia.downloads_path', $config['downloads_path'] ?? '%kernel.project_dir%/var/fakturownia');
        $container->setParameter('codevenom_fakturownia.timeout', $config['timeout'] ?? 30);

        if ($container->hasParameter('mcp.discovery.scan_dirs')) {
            $scanDirs = $container->getParameter('mcp.discovery.scan_dirs');
            $bundleSrc = 'vendor/codevenom/fakturownia-bundle/src';
            if (!in_array($bundleSrc, $scanDirs)) {
                $scanDirs[] = $bundleSrc;
                $container->setParameter('mcp.discovery.scan_dirs', $scanDirs);
            }
        }

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        if (!class_exists('Symfony\AI\McpBundle\McpBundle')) {
            $container->removeDefinition('Codevenom\FakturowniaBundle\Invoice\MCP\AddInvoice\AddInvoiceTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Invoice\MCP\FindInvoiceByNumber\FindInvoiceByNumberTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Customer\MCP\AddCustomer\AddCustomerTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Customer\MCP\DeleteCustomer\DeleteCustomerTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Customer\MCP\FindCustomerById\FindCustomerByIdTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Customer\MCP\ListCustomers\ListCustomersTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Customer\MCP\UpdateCustomer\UpdateCustomerTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Pricing\MCP\AddPriceList\AddPriceListTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Pricing\MCP\DeletePriceList\DeletePriceListTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Pricing\MCP\ListPriceLists\ListPriceListsTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Pricing\MCP\UpdatePriceList\UpdatePriceListTool');
            $container->removeDefinition('Codevenom\FakturowniaBundle\Report\MCP\GetReport\GetReportTool');
        }
    }
}