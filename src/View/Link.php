<?php

namespace App\View;

final class Link extends Component
{
    public function __construct(
        private readonly string $href,
        private readonly string $text,
        private readonly ?string $class = null
    ) {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $text = $this->e($this->text);
        $class = $this->class !== null ? ' class="' . $this->e($this->class) . '"' : '';

        return "<a href=\"{$href}\"{$class}>{$text}</a>";
    }
}