<?php

namespace FAFI\BE\Position\Repository;

use FAFI\BE\Position\Position;
use FAFI\exception\FafiException;

class PositionHydrator
{
    private array $requiredFields = [
        PositionResource::NAME_FIELD,
    ];


    /**
     * @param array $data
     *
     * @return Position[]
     * @throws FafiException
     */
    public function hydrateCollection(array $data): array
    {
        $transformed = [];
        foreach ($data as $row) {
            $entity = $this->hydrate($row);
            $transformed[] = $entity;
        }

        return $transformed;
    }

    /**
     * @param array $data
     *
     * @return Position
     * @throws FafiException
     */
    public function hydrate(array $data): Position
    {
        $this->validateRequiredFieldsOnHydration($data);

        return new Position(
            isset($data[PositionResource::ID_FIELD]) ? (int)$data[PositionResource::ID_FIELD] : null,

            $data[PositionResource::NAME_FIELD]
        );
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function validateRequiredFieldsOnHydration(array $data): void
    {
        $missed = [];
        foreach ($this->requiredFields as $field) {
            if (!isset($data[$field])) {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $e = sprintf(FafiException::E_REQ_MISSED, Position::ENTITY, implode('", "', $missed));
            throw new FafiException($e);
        }
    }


    public function extract(Position $entity): array
    {
        return [
            PositionResource::ID_FIELD => $entity->getId(),

            PositionResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
