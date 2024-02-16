<?php
declare(strict_types=1);

namespace Fignon\Extra;

use Fignon\Extra\ViewEngine;

/**
 * This is just a bridge between Fignon framework and Plates Php Engine
 *
 * For more customization, @see https://platesphp.com/engine/overview/
 *
 * When using this engine,  use as template name 'example' for 'example.php'
 */
class PlatesEngine implements ViewEngine
{
    protected $loader;

    public function init(string $templatePath = null, string $templateCachedPath = null, array $options = []): PlatesEngine
    {
        if (null === $templateCachedPath || null === $templatePath) {
            throw new \Fignon\Error\TunnelError('Template path or cached path is not set');
        }

        $this->loader = new \League\Plates\Engine($templatePath);

        return $this;
    }

    public function render(string $viewPath = '', $locals = [], array $options = []): string
    {

        if (null === $this->loader) {
            throw new \Fignon\Error\TunnelError('Template path or cached path is not set');
        }

        if (!\is_array($locals)) {
            throw new \Fignon\Error\TunnelError('Locals must be an array');
        }

        if ('' === $viewPath) {
            throw new \Fignon\Error\TunnelError('View path is empty');
        }

        return  $this->loader->render($viewPath, $locals);
    }
}
