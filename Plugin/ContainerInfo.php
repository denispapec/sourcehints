<?php
/**
 * @copyright See LICENCE.md
 * @package   Papec\SourceHints
 * @author    Denis Papec <denis.papec@gmail.com>
 */
declare(strict_types=1);
namespace Papec\SourceHints\Plugin;

/**
 * Class ContainerInfo
 *
 * @package Papec\SourceHints
 */
class ContainerInfo
{
    /**
     * @var \Papec\SourceHints\Model\Module
     */
    private $module;

    /**
     * ContainerInfo constructor.
     *
     * @param \Papec\SourceHints\Model\Module $module
     */
    public function __construct(
        \Papec\SourceHints\Model\Module $module
    ) {
        $this->module = $module;
    }

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
        if (!$this->module->isEnabled()) {
            return $proceed($name);
        }

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
