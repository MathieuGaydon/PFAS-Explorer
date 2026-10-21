<?php
namespace App\View;

final class Form extends Component {
    public function __construct(
        private readonly string $action,
        private readonly array $enfants,
        private readonly string $method = 'post'
    ) {}

    public function render(): string {
        $action = $this->e($this->action);
        $method = $this->e($this->method);
        $content = $this->renderAll($this->enfants);

        return <<<HTML
        <form method="{$method}" action="{$action}">
        {$content}
        </form>
        HTML;
    }
}