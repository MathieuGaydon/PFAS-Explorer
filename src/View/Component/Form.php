<?php

namespace App\View\Component;

final class Form extends Component
{
    public function __construct(
        private readonly string $action,
        private readonly array $enfants,
        private readonly string $method = 'post',
        private readonly string $class = 'auth-form'
    ) {
    }

    public function render(): string
    {
        $action = $this->e($this->action);
        $method = $this->e($this->method);
        $class = $this->e($this->class);
        $content = $this->renderAll($this->enfants);

        return <<<HTML
        <form method="{$method}" action="{$action}" class="{$class}">
        {$content}
        </form>
        HTML;
    }
}