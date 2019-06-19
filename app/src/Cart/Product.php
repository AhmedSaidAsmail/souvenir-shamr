<?php

namespace App\Src\Cart;


class Product
{
    private $fillable = [
        'details', 'quantity', 'product'
    ];
    /**
     * @var array $attributes
     */
    private $attributes;
    /**
     * @var array $details
     */
    public $details;
    /**
     * @var int $quantity
     */
    public $quantity;
    /**
     * @var \App\Models\Product
     */
    public $product;
    /**
     * @var int $price
     */
    public $price;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return $this
     */
    public function make()
    {
        return $this->setAttributesFields()
            ->setPrice();
    }

    /**
     * Set Fillable attributes
     *
     * @return $this
     */
    private function setAttributesFields()
    {
        array_map(function ($attribute) {
            if (property_exists($this, $attribute) && in_array($attribute, $this->fillable)) {
                $this->{$attribute} = $this->attributes[$attribute];
            }
        }, array_keys($this->attributes));
        return $this;
    }

    /**
     * Set Item Price
     *
     * @return $this
     * @throws NotValidProductException
     */
    private function setPrice()
    {
        if ($this->product instanceof \App\Models\Product) {
            $this->price = $this->product->price()['price'] * $this->quantity;
            return $this;
        }
        throw new NotValidProductException('This product is not valid');
    }

    public function __get($name)
    {
        return $this->product->$name;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->product, $name], [$arguments]);
    }


}