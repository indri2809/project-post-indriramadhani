<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class ProductController extends Controller
{
    public function index()
    {
      $product=Product::all();
      return view('product.index',[
        "title" =>"product",
        "data" => $product
      ]);
      }
      public function create():View
      {
        return view('product.create')->with([
            "title"=> "tambah Data Product",
            "data" =>Category::all()
        ]);
      }
      public function store(Request $request):RedirectResponse
      {
        $request->validate([
          "name"=>"required",
          "description"=>"nullable",
          "stock"=>"required",
          "price"=>"required",
          "category_id"=>"required"
        ]);
        Product::create($request->all());
        return redirect()->route('produk.index')->with('success','Data produk Berhasil Ditambahkan');
      }
      public function edit($id):View
      {
        $product=Product::find($id);
        // dd($product);
        return view('product.edit',compact('product'))->with([
          "title"=>"ubah Data product",
          "data"=>category::all()
        ]);
      }
      public function update(Request $request,$id):RedirectResponse
      {
        
        
        $data=$request->validate([
          "name"=>"required",
          "description"=>"nullable",
          "stock"=>"required",
          "price"=>"required",
          "category_id"=>"required"
        ]);

        Product::where('id',$id)->update($data);
        return redirect()->route('produk.index')->with('update','Data produk Berhasil Diubah');
      }
      public function show():View
      {
        $product=Product::all();
        return view('product.show')->with([
          "title"=>"Tampil Data Product",
          "data"=>$product
        ]);
      }
      public function destroy($id):RedirectResponse
      {
        Product::where('id',$id)->delete();
        return redirect()->route('produk.index')->with('delete','Data Produk Berhasil Dihapus');
      }
}
