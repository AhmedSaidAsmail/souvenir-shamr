<?php

namespace App\Src\Cart;

use Illuminate\Http\Request;

class ShoppingCart
{
    static $CartName = "cart";
    /**
     * @var Request $request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Inserting attributes to cart collection
     *
     * @param array $attributes
     */
    public function insert(array $attributes)
    {
        $collection = $this->collectionInstance();
        $collection->insert($attributes);
        $this->saveCollectionToSession($collection);

    }

    /**
     * Removing Cart collection item
     *
     * @param $product_id
     */
    public function remove($product_id)
    {
        $collection = $this->collectionInstance();
        $collection->remove($product_id);
        $this->saveCollectionToSession($collection);
    }

    /**
     * Providing CartCollection instance
     *
     * @return CartCollection
     */
    private function collectionInstance()
    {
        if ($this->requestHasCollection() && $this->requestHasValidCollection()) {
            return $this->request->session()->get(self::$CartName);
        }
        return new CartCollection();

    }

    /**
     * Determine if session has old cart collection
     *
     * @return bool
     */
    private function requestHasCollection()
    {
        return $this->request->session()->has(self::$CartName);
    }

    /**
     * Determine if the cart collection which stored in session is instance of CartCollection object
     *
     * @return bool
     */
    private function requestHasValidCollection()
    {
        return $this->request->session()->get(self::$CartName) instanceof CartCollection;
    }

    /**
     * Storing Cart Collection into session
     *
     * @param CartCollection $cartCollection
     */
    private function saveCollectionToSession(CartCollection $cartCollection)
    {
        $this->request->session()->put(self::$CartName, $cartCollection);
    }

    /**
     * Counting of all Cart Collection items
     *
     * @return int
     */
    public function count()
    {
        return (int)$this->collectionInstance()
            ->count();
    }

    /**
     * Returning all Cart Collection product
     *
     * @return Product[]
     */
    public function all()
    {
        return $this->collectionInstance()
            ->all();
    }

    /**
     * Returning all product total price
     *
     * @return int
     */
    public function total()
    {
        return $this->collectionInstance()
            ->total();
    }

    public function __toArray(callable $attributesFunc)
    {
        return array_map($attributesFunc, $this->collectionInstance()->all());
    }

    /**
     * Destroying current cart collection
     */
    public function destroy()
    {
        $this->request->session()->put(self::$CartName, new CartCollection());
    }


}