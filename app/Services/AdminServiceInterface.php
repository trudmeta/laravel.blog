<?php

namespace App\Services;

interface AdminServiceInterface
{
    /**
     * Creates new resource.
     *
     * @param array $params
     *
     * @return bool
     */
    public function create(array $params);

    /**
     * Updates the resource.
     *
     * @param int $id
     * @param array $params
     *
     * @return bool
     */
    public function update(array $params);

    /**
     * Deletes the resource.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id);
}
