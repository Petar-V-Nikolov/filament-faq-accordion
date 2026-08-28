<?php

declare(strict_types=1);

namespace Pnscripts\FilamentFaqAccordion;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FaqAccordionPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'pnscripts-faq-accordion';
    }

    public function register(Panel $panel): void
    {
    }

    public function boot(Panel $panel): void
    {
    }
}
