<?php
namespace App\View;

final class Paragraph extends Component {
    public function __construct(private readonly array $enfants) {}

    public function render(): string {
        $content = $this->renderAll($this->enfants);
        return "<p>$content</p>";
    }
}