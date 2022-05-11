<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Persistence\Client;

interface EntityClientInterface
{
    public function create($entity);
    public function update($entity);
}
