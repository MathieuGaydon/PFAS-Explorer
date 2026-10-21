<?php
namespace App\View;

final class Link extends Component {
    public function __construct(
        private readonly string $href,
        private readonly string $text
    ) {}

    public function render(): string {
        $href = $this->e($this->href);
        $text = $this->e($this->text);
        return "<a href=\"{$href}\">{$text}</a>";
    }
}