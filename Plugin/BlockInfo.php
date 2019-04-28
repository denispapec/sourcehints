<?php
/**
 * @copyright See LICENCE.md
 * @package   Papec\SourceHints
 * @author    Denis Papec <denis.papec@gmail.com>
 */
declare(strict_types=1);
namespace Papec\SourceHints\Plugin;

/**
 * Class BlockInfo
 *
 * @package Papec\SourceHints
 */
class BlockInfo
{
    /**
     * @var \Papec\SourceHints\Model\Module
     */
    private $module;

    /**
     * BlockInfo constructor.
     *
     * @param \Papec\SourceHints\Model\Module $module
     */
    public function __construct(
        \Papec\SourceHints\Model\Module $module
    ) {
        $this->module = $module;
    }

    /**
     *
     * @param \Magento\Framework\View\Element\Template $subject
     * @param string                                   $result
     *
     * @return string
     */
    public function afterFetchView(\Magento\Framework\View\Element\Template $subject, string $result) : string
    {
        if (!$this->module->isEnabled()) {
            return $result;
        }

        $templateFile = $subject->getTemplateFile();
        $blockName = $subject->getNameInLayout();

        return sprintf(
            '<!-- START TEMPLATE [%s] %s -->%s<!-- END TEMPLATE [%1$s] %2$s -->',
            $blockName,
            $templateFile,
            $result
        );
    }
}
