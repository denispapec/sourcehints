<?php
/**
 * @copyright See LICENCE.md
 * @package   Papec\SourceHints
 * @author    Denis Papec <denis.papec@gmail.com>
 */
namespace Papec\SourceHints\Plugin;

/**
 * Class ContainerInfo
 *
 * @package Papec\SourceHints
 */
class ContainerInfo
{
    /**
     * Add wrapper to html
     *
     * @param \Magento\Framework\View\Layout $subject
     * @param callable                       $proceed
     * @param string                         $name
     *
     * @return string
     */
    public function aroundRenderNonCachedElement(
        \Magento\Framework\View\Layout $subject,
        callable $proceed,
        string $name
    ) {
        if ($subject->isUiComponent($name)) {
            $wrapper = '<!-- START UI {{ %s }} -->%s<!-- END UI {{ %1$s }} -->';
        } elseif ($subject->isBlock($name)) {
            $wrapper = '<!-- START BLOCK {{ %s }} -->%s<!-- END BLOCK {{ %1$s }} -->';
        } elseif ($subject->isContainer($name)) {
            $wrapper = '<!-- START CONTAINER {{ %s }} -->%s<!-- END CONTAINER {{ %1$s }} -->';
        } else {
            $wrapper = '<!-- START {{ %s }} -->%s<!-- END {{ %1$s }} -->';
        }

        return sprintf(
            $wrapper,
            $name,
            $proceed($name)
        );
    }
}
