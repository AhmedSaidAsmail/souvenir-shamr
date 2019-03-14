<?php

namespace Sync\HasMany;

use App\Models\FilterItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sync implements SyncInterface
{
    /**
     * @var HasMany
     */
    public $relation;
    /**
     * @var array
     */
    private $data;
    /**
     * @var array
     */
    private $current_rows;
    public $all_related_models;
    /**
     * Listing of updated rows
     *
     * @var array $updated_rows
     */
    public $updated_rows;
    /**
     * Listing of deleted rows
     *
     * @var array $deleted_rows
     */
    public $deleted_rows;
    /**
     * Listing of new rows
     *
     * @var array $new_rows
     */
    public $new_rows;
    /**
     * The local key of hasmany model
     *
     * @var string $local_key
     */
    public $local_key = 'id';

    /**
     * @param HasMany $relation
     * @param array $data
     * @return $this
     */
    public function setAttributes(HasMany $relation, array $data)
    {
        $this->relation = $relation;
        $this->data = $data;
        $this->all_related_models = $relation->get();
        $this->current_rows = $this->all_related_models->toArray();
        $this->init();
        return $this;
    }

    /**
     * Setting updated , deleted and new rows
     *
     * @return void
     */
    private function init()
    {
        $this->setUpdatedRows()
            ->setDeletedRows()
            ->setNewRows();

    }

    /**
     * Setting listing of updated rows
     *
     * @return $this
     */
    private function setUpdatedRows()
    {
        $this->updated_rows = array_filter($this->data, function ($row) {
            return array_key_exists($this->local_key, $row);
        });
        return $this;
    }

    /**
     * Setting listing of deleted rows
     *
     * @return $this
     */
    private function setDeletedRows()
    {
        $this->deleted_rows = array_udiff($this->current_rows, $this->updated_rows, function ($a, $b) {
            $id1 = $a[$this->local_key];
            $id2 = $b[$this->local_key];
            if ($id1 == $id2) {
                return 0;
            }
            return $id1 > $id2 ? 1 : -1;
        });
        return $this;
    }

    /**
     * Setting listing of new rows to create on storage
     *
     * @return $this
     */
    private function setNewRows()
    {
        $this->new_rows = array_diff_key($this->data, $this->updated_rows);
        return $this;
    }

    /**
     * Setting local key of hasmany model
     *
     * @param $key
     */
    public function setLocalKey($key)
    {
        $this->local_key = $key;
    }

    /**
     * Sync update ,delete and create methods
     */
    public function sync()
    {
        $builder = new SyncBuilder($this);
        $builder->sync();
    }

}