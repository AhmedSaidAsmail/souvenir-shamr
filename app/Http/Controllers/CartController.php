<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class CartController extends Controller
{
    public function __construct()
    {
    }

    public function index($lang)
    {
        return view('front.cart.index', ['lang' => $lang, 'cart' => cart()]);
    }

    public function store(Request $request, $lang)
    {
        $attributes = $request->all();
        $this->convertProductToModel($attributes);
        try {
            cart()->insert($attributes);
            return redirect()->route('cart.index', compact('lang'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function checkout($lang)
    {
        $cart = cart();
        if ($add = auth()->guard('customer')->user()->details) {
            return redirect()->route('cart.payment', compact('lang', 'cart'));
        }
        return view('front.cart.checkout', compact('lang', 'cart'));
    }

    private function convertProductToModel(array &$attributes)
    {
        array_walk($attributes, function (&$item, $key) {
            if ($key == "product") {
                $item = Product::findOrFail($item);
            }
        });
    }

    public function destroy($lang, $cart_id)
    {
        cart()->remove($cart_id);
        return redirect()->route('cart.index', compact('lang'));
    }

    public function payment($lang)
    {
        $cart = cart();
        return view('front.cart.payment', compact('lang', 'cart'));
    }

}