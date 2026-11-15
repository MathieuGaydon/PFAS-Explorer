<?php

namespace App\View\Component;

final class Input extends Component
{
    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $type = 'text',
        private readonly string $value = '',
        private readonly bool $required = true
    ) {
    }

    public function render(): string
    {
        $name = $this->e($this->name);
        $label = $this->e($this->label);
        $type = $this->e($this->type);
        $value = $this->e($this->value);
        $requiredAttr = $this->required ? ' required' : '';

        return <<<HTML
        <div class="form-group">
            <label for="{$name}">{$label}</label>
            <input type="{$type}" id="{$name}" name="{$name}" value="{$value}"{$requiredAttr}>
        </div>
        HTML;
    }
}