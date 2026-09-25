<?php

declare(strict_types=1);

namespace Shopwell\Tests\Rule\BestPractise\fixtures\DALDefinitionRule;

use Shopwell\Core\Framework\DataAbstractionLayer\Entity;
use Shopwell\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopwell\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\ChildrenAssociationField;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopwell\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopwell\Core\Framework\DataAbstractionLayer\FieldCollection;

class TreeDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'tree';
    }

    public function getEntityClass(): string
    {
        return TreeEntity::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            new ChildrenAssociationField(self::class),
            new ChildrenAssociationField(self::class, 'customChildren'),
        ]);
    }
}

class TreeEntity extends Entity
{
    use EntityIdTrait;
}
