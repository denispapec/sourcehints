<?php
/**
 * @copyright See LICENCE.md
 * @package   Papec\SourceHints
 * @author    Denis Papec <denis.papec@gmail.com>
 */
namespace Papec\SourceHints\Plugin;

/**
 * Class BlockInfo
 *
 * @package Papec\SourceHints
 */
class BlockInfo
{
    /**
     *
     * @param \Magento\Framework\View\Element\Template $subject
     * @param string                                   $result
     *
     * @return string
     */
    public function afterFetchView(\Magento\Framework\View\Element\Template $subject, string $result)
    {
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
