<?php
namespace App\View;

final class Alert extends Component {
    public function __construct(private readonly array $messages) {}

    public function render(): string {
        if (empty($this->messages)) {
            return '';
        }

        $items = '';
        foreach ($this->messages as $message) {
            $msg = $this->e($message);
            $items .= "<li>{$msg}</li>";
        }
        return "<ul>{$items}</ul>";
    }
}