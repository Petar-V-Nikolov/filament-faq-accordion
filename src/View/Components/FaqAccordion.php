<?php

declare(strict_types=1);

namespace Pnscripts\FilamentFaqAccordion\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Pnscripts\FilamentFaqAccordion\Forms\Components\FaqList;

class FaqAccordion extends Component
{
    /** @var list<array{question: string, answer: string}> */
    public array $items;

    /**
     * @param  list<array<string, mixed>>  $items
     */
    public function __construct(array $items = [])
    {
        $this->items = FaqList::normalize($items);
    }

    public function render(): View
    {
        return view('pnscripts-faq-accordion::components.faq-accordion');
    }
}
