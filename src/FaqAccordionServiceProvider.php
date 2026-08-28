<?php

declare(strict_types=1);

namespace Pnscripts\FilamentFaqAccordion;

use Illuminate\Support\ServiceProvider;
use Pnscripts\FilamentFaqAccordion\View\Components\FaqAccordion;

class FaqAccordionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pnscripts-faq-accordion');

        $this->loadViewComponentsAs('pnscripts', [
            FaqAccordion::class,
        ]);
    }
}
