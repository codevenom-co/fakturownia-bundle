<?php

namespace Symfony\Config;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class CodevenomFakturowniaConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $baseUrl;
    private $apiToken;
    private $sellerName;
    private $downloadsPath;
    private $timeout;
    private $_usedProperties = [];
    private $_hasDeprecatedCalls = false;

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function baseUrl($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['baseUrl'] = true;
        $this->baseUrl = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function apiToken($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['apiToken'] = true;
        $this->apiToken = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|mixed $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function sellerName($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['sellerName'] = true;
        $this->sellerName = $value;

        return $this;
    }

    /**
     * @default '%kernel.project_dir%/var/fakturownia'
     * @param ParamConfigurator|mixed $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function downloadsPath($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['downloadsPath'] = true;
        $this->downloadsPath = $value;

        return $this;
    }

    /**
     * @default 10
     * @param ParamConfigurator|int $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function timeout($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['timeout'] = true;
        $this->timeout = $value;

        return $this;
    }

    public function getExtensionAlias(): string
    {
        return 'codevenom_fakturownia';
    }

    public function __construct(array $config = [])
    {
        if (array_key_exists('base_url', $config)) {
            $this->_usedProperties['baseUrl'] = true;
            $this->baseUrl = $config['base_url'];
            unset($config['base_url']);
        }

        if (array_key_exists('api_token', $config)) {
            $this->_usedProperties['apiToken'] = true;
            $this->apiToken = $config['api_token'];
            unset($config['api_token']);
        }

        if (array_key_exists('seller_name', $config)) {
            $this->_usedProperties['sellerName'] = true;
            $this->sellerName = $config['seller_name'];
            unset($config['seller_name']);
        }

        if (array_key_exists('downloads_path', $config)) {
            $this->_usedProperties['downloadsPath'] = true;
            $this->downloadsPath = $config['downloads_path'];
            unset($config['downloads_path']);
        }

        if (array_key_exists('timeout', $config)) {
            $this->_usedProperties['timeout'] = true;
            $this->timeout = $config['timeout'];
            unset($config['timeout']);
        }

        if ($config) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($config)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['baseUrl'])) {
            $output['base_url'] = $this->baseUrl;
        }
        if (isset($this->_usedProperties['apiToken'])) {
            $output['api_token'] = $this->apiToken;
        }
        if (isset($this->_usedProperties['sellerName'])) {
            $output['seller_name'] = $this->sellerName;
        }
        if (isset($this->_usedProperties['downloadsPath'])) {
            $output['downloads_path'] = $this->downloadsPath;
        }
        if (isset($this->_usedProperties['timeout'])) {
            $output['timeout'] = $this->timeout;
        }
        if ($this->_hasDeprecatedCalls) {
            trigger_deprecation('symfony/config', '7.4', 'Calling any fluent method on "%s" is deprecated; pass the configuration to the constructor instead.', $this::class);
        }

        return $output;
    }

}
