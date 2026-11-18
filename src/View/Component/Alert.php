<?php

namespace App\View\Component;

final class Alert extends Component
{
    public function __construct(
        private readonly array $messages,
        private readonly string $type = 'error'
    ) {
    }

    public function render(): string
    {
        if (empty($this->messages)) {
            return '';
        }

        $items = '';

        foreach ($this->messages as $message) {
            $msg = $this->e($message);
            $items .= "<li>{$msg}</li>";
        }

        $class = $this->type === 'success' ? 'form-success' : 'form-errors';

        return "<div class=\"{$class}\"><ul>{$items}</ul></div>";
    }
}