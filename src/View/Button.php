<?php
namespace App\View;

final class Button extends Component {
    public function __construct(private readonly string $label) {}

    public function render(): string {
        $label = $this->e($this->label);
        return "<button type=\"submit\">{$label}</button>";
    }
}