<?php

declare(strict_types=1);

namespace Pnscripts\FilamentFaqAccordion\Forms\Components;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

/**
 * Repeater-like FAQ field. Question + answer rows are stored as an array.
 * normalize() is plain PHP so unit tests do not boot a Filament app.
 */
class FaqList extends Repeater
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('FAQ items');
        $this->schema([
            TextInput::make('question')
                ->label('Question')
                ->required(),
            Textarea::make('answer')
                ->label('Answer')
                ->rows(4),
        ]);
        $this->default([]);
        $this->dehydrated();
        $this->dehydrateStateUsing(function (mixed $state): array {
            return self::normalize(is_array($state) ? $state : []);
        });
    }

    /**
     * @param  list<array<string, mixed>|mixed>  $items
     * @return list<array{question: string, answer: string}>
     */
    public static function normalize(array $items): array
    {
        $out = [];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $question = trim((string) ($item['question'] ?? ''));
            if ($question === '') {
                continue;
            }

            $out[] = [
                'question' => $question,
                'answer' => (string) ($item['answer'] ?? ''),
            ];
        }

        return $out;
    }
}
