<?php

declare(strict_types=1);

namespace Shopwell\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Shopwell\PhpStan\Rule\FutureCompatibility\ClassMovedUsage;
use Shopwell\PhpStan\Rule\FutureCompatibility\FutureClassMovedExpressionUsageRule;
use Shopwell\PhpStan\Tests\Fixture\FutureClassMovedUsageRule\Canonical\MovedSubject;

/**
 * @extends RuleTestCase<FutureClassMovedExpressionUsageRule>
 * @internal
 */
class FutureClassMovedExpressionUsageRuleTest extends RuleTestCase
{
    public function testReportsOldClassNamesInExpressions(): void
    {
        $message = 'Class "Shopwell\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject" moved to "Shopwell\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Canonical\\MovedSubject". Use the new name now.';

        $this->analyse([__DIR__ . '/fixtures/FutureClassMovedUsageRule/usage.php'], [
            [$message, 18],
            [$message, 21],
            [$message, 22],
            [$message, 23],
            [$message, 34],
        ]);
    }

    protected function getRule(): Rule
    {
        return new FutureClassMovedExpressionUsageRule(new ClassMovedUsage([
            'Shopwell\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject' => MovedSubject::class,
        ]));
    }
}
