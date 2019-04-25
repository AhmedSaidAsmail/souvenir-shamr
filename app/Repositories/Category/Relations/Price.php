<?php

namespace App\Repositories\Category\Relations;

use App\Repositories\Category\Query\QueryFactory;
use Illuminate\Support\Facades\DB;

class Price
{
    /**
     * @var QueryFactory $factory
     */
    private $factory;

    public function __construct(QueryFactory $factory)
    {
        $this->factory = $factory;
    }

    public function max()
    {
        return $this->maxQuery()[0]->max;

    }

    private function maxQuery()
    {
        return $this->factory
            ->makeQuery()
            ->select(DB::raw('max(products.price) as max'))
            ->get()
            ->all();
    }

    public function min()
    {
        return $this->minQuery()[0]->min;
    }

    private function minQuery()
    {
        return $this->factory
            ->makeQuery()
            ->select(DB::raw('min(products.price) as min'))
            ->get()
            ->all();
    }

}