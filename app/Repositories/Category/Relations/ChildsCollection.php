<?php

namespace App\Repositories\Category\Relations;


use App\Repositories\Category\Query\QueryFactory;

class ChildsCollection implements CollectionInterface
{
    /**
     * @var \App\Models\Category[] $child |null
     */
    private $child;
    /**
     * @var QueryFactory $factory
     */
    private $factory;

    public function __construct(QueryFactory $factory, array $child)
    {
        $this->factory = $factory;
        $this->child = $child;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return \Illuminate\Support\Collection
     */
    public function get($limit=null,$offset=null)
    {
        return collect(array_map(function ($category) {
            return new Child($this->factory, $category);
        }, $this->child));
    }
}