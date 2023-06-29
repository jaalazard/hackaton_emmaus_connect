<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
class PhoneSearch
{
    private ?string $search = null;

    #[Assert\PositiveOrZero()]
    #[Assert\LessThan(propertyPath:'maxPrice')]
    private ?int $minPrice = null;

    #[Assert\Positive()]
    private ?int $maxPrice = null;

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(?string $search): static
    {
        $this->search = $search;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): static
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): static
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}