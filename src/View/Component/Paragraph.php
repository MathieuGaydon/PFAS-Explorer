<?php

namespace App\View\Component;

final class Paragraph extends Component
{
    public function __construct(
        private readonly array $enfants,
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $content = $this->renderAll($this->enfants);
        $classAttr = $this->class !== '' ? " class=\"{$this->class}\"" : '';

        return "<p{$classAttr}>$content</p>";
    }
}