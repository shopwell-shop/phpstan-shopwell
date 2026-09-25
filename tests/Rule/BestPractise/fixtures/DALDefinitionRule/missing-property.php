<?php

declare(strict_types=1);

namespace Shopwell\Tests\Rule\BestPractise\fixtures\DALDefinitionRule;

use Shopwell\Core\Framework\DataAbstractionLayer\Entity;
use Shopwell\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopwell\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopwell\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\StringField;

class FooDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'foo';
    }

    public function getEntityClass(): string
    {
        return FooEntity::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),

            new StringField('name', 'name'),
        ]);
    }
}

class FooEntity extends Entity
{
    use EntityIdTrait;
}
