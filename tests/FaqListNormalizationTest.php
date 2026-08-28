<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Pnscripts\FilamentFaqAccordion\Forms\Components\FaqList;

final class FaqListNormalizationTest extends TestCase
{
    public function test_it_skips_empty_questions(): void
    {
        $items = FaqList::normalize([
            ['question' => '', 'answer' => 'nope'],
            ['question' => '  ', 'answer' => 'spaces only'],
            ['question' => 'What is MIT?', 'answer' => 'A license.'],
            ['question' => 'Shipping', 'answer' => ''],
        ]);

        $this->assertCount(2, $items);
        $this->assertSame('What is MIT?', $items[0]['question']);
        $this->assertSame('A license.', $items[0]['answer']);
        $this->assertSame('Shipping', $items[1]['question']);
        $this->assertSame('', $items[1]['answer']);
    }
}
