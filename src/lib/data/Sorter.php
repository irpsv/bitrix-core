<?php

namespace olof_core\data;

class Sorter
{
    const ASC = 'asc';
    const ASC_NAT = 'nasc';
    const DESC = 'desc';
    const DESC_NAT = 'ndesc';

    protected $columns = [];

    public function __construct(array $columns = [])
    {
        foreach ($columns as $column => $value) {
            $this->set($column, $value);
        }
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getColumn(string $name)
    {
        return $this->getColumns()[$name] ?? null;
    }

    public function set(string $column, $sort)
    {
        $types = [
            self::ASC,
            self::ASC_NAT,
            self::DESC,
            self::DESC_NAT
        ];

        if (is_callable($sort) || in_array($sort, $types)) {
            $this->columns[$column] = $sort;
        }
        else {
            throw new \Exception('Invalide sort type. Column: '.$column);
        }
    }
}
