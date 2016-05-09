<?php

namespace App\Api\Controllers\Traits;

trait dataFormatterTrait {

    /**
     * Make sure the OrderBy column is a valid one
     *
     * @param $column
     * @param $valid_columns
     * @return mixed
     */
    protected function formatOrderBy($column, $valid_columns) {
        return in_array($column, $valid_columns) ? $column : $valid_columns[0];
    }
}