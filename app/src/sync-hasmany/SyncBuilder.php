<?php

namespace Sync\HasMany;


class SyncBuilder implements SyncInterface
{
    /**
     * @var Sync $wrapper
     */
    private $wrapper;

    /**
     * SyncBuilder constructor.
     * @param Sync $wrapper
     */
    public function __construct(Sync $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * Sync update ,delete and create methods
     */
    public function sync()
    {
        $this->update()
            ->create()
            ->delete();

    }

    /**
     * Updating current rows
     *
     * @return $this
     */
    private function update()
    {
        foreach ($this->wrapper->all_related_models as $model) {
            if ($row = $this->modelBelongToListing($model, $this->wrapper->updated_rows)) {
                $model->update($row);
            }

        }
        return $this;
    }

    /**
     * Creating new rows
     *
     * @return $this
     */
    private function create()
    {
        if ($new_rows = $this->wrapper->new_rows) {
            $this->wrapper->relation
                ->createMany($this->wrapper->new_rows);
        }
        return $this;
    }

    /**
     * Deleting the rows
     */
    private function delete()
    {
        foreach ($this->wrapper->all_related_models as $model) {
            if ($row = $this->modelBelongToListing($model, $this->wrapper->deleted_rows)) {
                $model->delete($row);
            }

        }
        return $this;

    }

    private function modelBelongToListing($model, array $listing)
    {
        $local_key = $this->wrapper->local_key;
        $result = array_filter($listing, function ($row) use ($model, $local_key) {
            return $row[$local_key] == $model->{$local_key};
        });
        return !empty($result) ? current($result) : false;
    }


}