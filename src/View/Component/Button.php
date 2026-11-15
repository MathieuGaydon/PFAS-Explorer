<?php

namespace App\View\Component;

final class Button extends Component
{
    public function __construct(
        private readonly string $label,
        private readonly string $type = 'submit',
        private readonly string $class = 'btn-submit'
    ) {
    }

    public function render(): string
    {
        $label = $this->e($this->label);
        $type = $this->e($this->type);
        $class = $this->e($this->class);

        return "<button type=\"{$type}\" class=\"{$class}\">{$label}</button>";
    }
}