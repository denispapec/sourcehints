<?php
/**
 * @copyright See LICENCE.md
 * @package   Papec\SourceHints
 * @author    Denis Papec <denis.papec@gmail.com>
 */
declare(strict_types=1);
namespace Papec\SourceHints\Model;

/**
 * Class Module
 * @package Papec\SourceHints
 */
class Module
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;
    private $isEnabled;

    /**
     * BlockInfo constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Return module status
     *
     * @return bool
     */
    public function isEnabled() : bool
    {
        if ($this->isEnabled !== null) {
            return $this->isEnabled;
        }

        return $this->isEnabled = !! $this->scopeConfig->getValue('dev/debug/source_hints');
    }
}
