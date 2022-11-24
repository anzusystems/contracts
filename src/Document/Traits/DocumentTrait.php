<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Document\Traits;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use AnzuSystems\Contracts\Document\Attributes\PersistedName;
use AnzuSystems\Contracts\Document\Interfaces\DocumentInterface;
use AnzuSystems\Contracts\Entity\Traits\NamedResourceTrait;

trait DocumentTrait
{
    use NamedResourceTrait;

    #[PersistedName('_id')]
    #[Serialize(persistedName: '_id')]
    private string $id = '';

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function is(DocumentInterface $document): bool
    {
        if ($document::getResourceName() === $this->getResourceName()) {
            return $document->getId() === $this->getId();
        }

        return false;
    }
}
