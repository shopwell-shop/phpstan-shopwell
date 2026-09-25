<?php

declare(strict_types=1);

namespace Shopwell\PhpStan\Tests\Rule\fixtures\InternalMethodCallRule;

class SomeClass
{
    /**
     * @internal
     */
    public function internalMethod(): void {}
}
