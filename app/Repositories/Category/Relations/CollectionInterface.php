<?php

namespace App\Repositories\Category\Relations;


interface CollectionInterface
{
    /**
     * @param null $limit
     * @param null $offset
     * @return \Illuminate\Support\Collection
     */
     function get($limit=null,$offset=null);
}