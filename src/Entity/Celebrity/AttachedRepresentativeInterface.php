<?php

namespace App\Entity\Celebrity;

use App\Entity\Celebrity;
use App\Entity\Representative;

interface AttachedRepresentativeInterface
{
    public function getRepresentative(): ?Representative;

    public function setRepresentative(?Representative $representative): AttachedRepresentativeInterface;

    public function getCelebrity(): ?Celebrity;

    public function setCelebrity(?Celebrity $celebrity): AttachedRepresentativeInterface;
}
