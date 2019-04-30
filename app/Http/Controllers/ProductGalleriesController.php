<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleriesController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = "/images/products/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer $product_id
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param integer $product_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        /**
         * @var Product $product
         */
        $product = Product::findOrFail($product_id);
        $attributes = $request->has('gallery') ? $request->all()['gallery'] : [];
        uploadingResolver()
            ->model(new ProductGallery())
            ->multipleUpload($attributes, 'image', $this->path, function ($image) {
                $image->thumb(305, 'thumbMd')
                    ->thumb(152, 'thumbSm');
            });
        try {
            resolve('sync')
                ->setAttributes($product->gallery(), $attributes)
                ->sync();
            return redirect()->route('admin.products.index')->with('success', 'Successfully product has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
