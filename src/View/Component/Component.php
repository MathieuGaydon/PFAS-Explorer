<?php

namespace App\View\Component;

abstract class Component
{
    public function __toString(): string
    {
        return $this->render();
    }

    abstract public function render(): string;

    /** @param array<Component|string> $enfants */
    protected function renderAll(array $enfants): string
    {
        $html = '';

        foreach ($enfants as $enfant) {
            $html .= $enfant instanceof Component ? $enfant->render() : $this->e($enfant);
        }

        return $html;
    }

    protected function e(string $texte): string
    {
        return htmlspecialchars($texte, ENT_QUOTES);
    }
}