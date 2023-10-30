<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $companies = Company::all();
        $keyword = $request->input('keyword');
        $company_name = $request->input('company_name');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_stock = $request->input('min_stock');
        $max_stock = $request->input('max_stock');
    
        $products = $this->product->getAllProducts($keyword, $company_name, $min_price, $max_price, $min_stock, $max_stock);
    
        return view('index', compact('companies', 'products', 'keyword'));
    }
    

    public function create()
    {
        $companies = Company::all();
        return view('create', compact('companies'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $request->only(['product_name', 'company_id', 'price', 'stock', 'comment']);
            
            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')->store('public');
                $data['img_path'] = $img_path;
            }

            $this->product->storeProduct($data);

            return redirect()->route('index')->with('message', '新規商品を登録しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '新規商品を登録できませんでした。');
        }
    }

    public function show($id)
    {
        $product = $this->product->findProduct($id);
        return view("show", compact('product'));
    }

    public function edit($id)
    {
        $product = $this->product->findProduct($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $data = $request->only(['product_name', 'company_name', 'price', 'stock', 'comment']);
            
            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')->store('public');
                $data['img_path'] = $img_path;
            }

            $this->product->updateProduct($id, $data);

            return redirect()->route('show', $id)->with('message', '商品内容を更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '商品内容を更新できませんでした。');
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->product->findProduct($id);
            if ($product) {
                Storage::delete($product->img_path);
                $this->product->deleteProduct($id);
            }
            return redirect()->route('index')->with('message', '商品情報を削除しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '商品を削除できませんでした。');
        }
    }
}
