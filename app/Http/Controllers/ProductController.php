<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::all();
        $keyword = $request->input('keyword');
        $company_name = $request->input('company_name');
        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if(isset($company_name)){
            $query->where('company_id', $company_name);
        }
        $products = $query->get();

        return view('index')->with('companies', $companies )->with('products', $products)->with('keyword', $keyword);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
        DB::beginTransaction();

        try {
                $product = new Product;
                $product->product_name = $request->input(["product_name"]);
                $product->company_id = $request->input(["company_name"]);
                $product->price = $request->input(["price"]);
                $product->stock = $request->input(["stock"]);
                $product->comment = $request->input(["comment"]);
                if (request('img_path')){
                    $img_path = $request->file('img_path')->store('public');
                    $product->img_path = $img_path;
                }
                $product->save();
                
                DB::commit();
        
                return redirect()->route('index')->with('message', '新規商品を登録しました。');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', '新規商品を登録できませんでした。');
            }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = Product::find($request->id);  
        return view("show", ["product" => $product]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Product::find($request->id);
        $companies = Company::all();
        return view('edit')->with('product', $product)->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {   
        DB::beginTransaction();

    try {
            $product = Product::find($id);

            $product->product_name = $request->input(["product_name"]);
            $product->company_id = $request->input(["company_name"]);
            $product->price = $request->input(["price"]);
            $product->stock = $request->input(["stock"]);
            $product->comment = $request->input(["comment"]);
            if (request('img_path')){
                $img_path = $request->file('img_path')->store('public');
                $product->img_path = $img_path;
            }
            $product->save();

            DB::commit();

            return redirect()->route('show', $id)->with('message', '商品内容を更新しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', '商品内容を更新できませんでした。');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::find($id);
            $product->delete();
    
            DB::commit();
    
            return redirect()->route('index')->with('message', '商品情報を削除しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', '商品を削除できませんでした。');
        }
    }
}
