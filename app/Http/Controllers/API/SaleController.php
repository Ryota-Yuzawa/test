<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\Product;
use App\models\Sale;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function purchase(Request $request)
    {
        // トランザクションを開始
        DB::beginTransaction();

        try {
            // リクエストから必要なデータを取得する
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity', 1);

            // データベースから対象の商品を検索・取得
            $product = Product::find($product_id);

            // 商品が存在しない場合のバリデーションを行う
            if (!$product) {
                return response()->json(['message' => '商品が存在しません'], 404);
            }

            // 在庫が不足している場合のバリデーションを行う
            if ($product->stock < $quantity) {
                return response()->json(['message' => '商品が在庫不足です'], 400);
            }

            // 在庫を減少させる
            $product->stock -= $quantity;
            $product->save();

            // Salesテーブルに商品IDと購入日時を記録する
            $sale = new Sale([
                'product_id' => $product_id,
            ]);

            $sale->save();

            // トランザクションをコミット
            DB::commit();

            // レスポンスを返す
            return response()->json(['message' => '購入成功']);
        } catch (\Exception $e) {
            // エラーが発生した場合、トランザクションをロールバック
            DB::rollback();

            // エラーをログに記録するなどの処理を追加できます

            // エラーレスポンスを返す
            return response()->json(['message' => '購入処理に失敗しました'], 500);
        }
    }
}
