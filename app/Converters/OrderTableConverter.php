<?php

namespace WTG\Converters;

use Doctrine\ORM\EntityRepository;

class OrderTableConverter extends AbstractTableConverter implements TableConverter
{
    public function getColumns(): array
    {
        // TODO: Implement getColumnMap() method.
    }

    public function getEntity(): string
    {
        // TODO: Implement getEntity() method.
    }

    public function createEntity(array $data)
    {
        // TODO: Implement createEntity() method.
    }

    /**
     * Map the csv fields.
     *
     * @param  array  $data
     * @return array
     */
    public function mapCsvFields(array $data)
    {
        foreach ($data as $index => $value) {
            $data[$this->csvFields[$index]] = $value;

            unset($data[$index]);
        }
        dd($data);
        return $data;
    }
}