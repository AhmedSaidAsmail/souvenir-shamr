<?php

namespace App\Src\Cart;


class CartCollection
{
    /**
     * @var int $quantity
     */
    private $quantity;
    /**
     * @var int $total
     */
    private $total;
    /**
     * @var Product[]
     */
    private $products = [];

    /**
     * Inserting new product to collection products array
     *
     * @param array $attributes
     */
    public function insert(array $attributes)
    {
        $product = (new Product($attributes))->make();
        $this->insertProductToCollection($product);

    }

    private function productIsAlreadyExists($id)
    {
        return array_key_exists($id, $this->products);
    }

    private function updateExistingProduct(Product $product)
    {
        $this->products[$product->product->id] = $product;
    }

    private function insertNewProduct(Product $product)
    {
        $this->products[$product->product->id] = $product;
        $this->quantity++;
        $this->total += $product->price;
    }

    private function insertProductToCollection(Product $product)
    {
        if ($this->productIsAlreadyExists($product->product->id)) {
            $this->updateExistingProduct($product);
        } else {
            $this->insertNewProduct($product);
        }
    }

    /**
     * Removing specified product from products array
     *
     * @param $product_id
     */
    public function remove($product_id)
    {
        if ($this->productIsExists($product_id) && $product = $this->products[$product_id]) {
            unset($this->products[$product_id]);
            $this->quantity--;
            $this->total -= $product->price;
        }

    }

    /**
     * Determine if this item exists in products array
     *
     * @param  $product_id
     * @return bool
     */
    private function productIsExists($product_id)
    {
        return array_key_exists($product_id, $this->products);
    }

    /**
     * Counting of all  Collection items
     *
     * @return int
     */
    public function count()
    {
        return $this->quantity;
    }

    /**
     * Returning all  Collection product
     *
     * @return Product[]
     */
    public function all()
    {
        return $this->products;
    }

    /**
     * Returning all product total price
     *
     * @return int
     */
    public function total()
    {
        return $this->total;
    }

}