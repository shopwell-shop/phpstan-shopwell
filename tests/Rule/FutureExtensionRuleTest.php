<?php

declare(strict_types=1);

namespace Shopwell\PhpStan\Tests\Rule;

use PHPStan\PhpDoc\TypeStringResolver;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Shopwell\PhpStan\Rule\FutureCompatibility\AnnouncedTypeResolver;
use Shopwell\PhpStan\Rule\FutureCompatibility\FutureExtensionRule;

/**
 * @extends RuleTestCase<FutureExtensionRule>
 * @internal
 */
class FutureExtensionRuleTest extends RuleTestCase
{
    public function testReportsFutureIncompatibleExtensions(): void
    {
        $this->analyse([__DIR__ . '/fixtures/FutureExtensionRule/future-extenders.php'], [
            ['"Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtendsFinal" extends "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\WillBeFinal", which will become final in v6.8.0. There is no forward-compatible way to keep extending it.', 42],
            ['"Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtendsInternal" extends "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\WillBeInternal", which will become internal in v6.8.0. Stop extending it to stay compatible.', 44],
            ['"Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtensionPointBase::gainsParameter()" will get a new optional parameter $states (array) in v6.8.0. Add it to the override in "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\IncompatibleExtension" now to stay compatible with both versions.', 48],
            ['"Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtensionPointBase::toBeAbstract()" will become abstract in v6.8.0. Implement it in "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\IncompatibleExtension" now to stay compatible with both versions.', 48],
            ['Parameter $value of "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtensionPointBase::widensParameter()" will be widened to string|int in v6.8.0. Widen the override in "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\IncompatibleExtension" now to stay compatible with both versions.', 48],
            ['The return type of "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\ExtensionPointBase::narrowsReturn()" will be narrowed to string in v6.8.0. Narrow the override in "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\IncompatibleExtension" now to stay compatible with both versions.', 48],
            ['"Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\LaterDeprecatedExtension" extends "Shopwell\\PhpStan\\Tests\\Fixture\\FutureExtensionRule\\WillBeFinal", which will become final in v6.8.0. There is no forward-compatible way to keep extending it.', 102],
        ]);
    }

    protected function getRule(): Rule
    {
        $reflectionProvider = self::createReflectionProvider();

        return new FutureExtensionRule(new AnnouncedTypeResolver(
            self::getContainer()->getByType(TypeStringResolver::class),
            $reflectionProvider,
        ));
    }
}
