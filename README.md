# Filament FAQ Accordion

Composer package by [PN Scripts](https://pnscripts.com) for **Laravel 13** and **Filament 5**. Store FAQ rows as a question/answer array on a Filament resource, then render an accessible accordion on the public site.

This is a library, not a full Laravel app.

## What it does

- Filament plugin id `pnscripts-faq-accordion`
- Form component `FaqList` (repeater-like: question + answer, empty questions dropped)
- Blade `<x-pnscripts-faq-accordion :items="$items" />` (Alpine if present, vanilla otherwise)
- First item is open
- No payment

## Requirements

- PHP 8.3+
- Laravel 13 (`illuminate/support` ^13.0)
- Filament 5

## Install

Until the package is on Packagist, require the public GitHub repository:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/pnscripts/filament-faq-accordion"
        }
    ]
}
```

```bash
composer require pnscripts/filament-faq-accordion:dev-main
```

Register the plugin on the panel:

```php
use Pnscripts\FilamentFaqAccordion\FaqAccordionPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(FaqAccordionPlugin::make());
}
```

Use the form component in a resource:

```php
use Pnscripts\FilamentFaqAccordion\Forms\Components\FaqList;

public static function form(Schema $schema): Schema
{
    return $schema->components([
        FaqList::make('faq_items'),
    ]);
}
```

Render on the public site (pass the stored array):

```blade
<x-pnscripts-faq-accordion :items="$page->faq_items ?? []" />
```

Files are distributed on GitHub, or later on CodeCanyon. [pnscripts.com](https://pnscripts.com) does not take payment for this package.

## Tests

```bash
composer install
composer test
```

Normalization is a plain PHP unit. Panel wiring still needs a Laravel + Filament app to click through.

## License

MIT.
