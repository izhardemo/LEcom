<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDislike;
use App\Models\ProductLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productLike(Request $request)
    {
        $product = Product::with(['likes'])->whereId($request->product_id)->first();

        if ($product) {
            $data = [
                'product_id' => $request->product_id,
                'user_id' => Auth::guard('sanctum')->check() ? Auth::guard('api')->user()->id : mt_rand(1, 10),
            ];
            $productLiked = ProductLike::where(['product_id'=>$data['product_id'], 'user_id'=>$data['user_id']])->first();
            if ($productLiked) {
                $productLiked->delete();
            } else {
                $productLike = ProductLike::create($data);
            }
            return response()->json(['status' => 'success', 'data' => [], 'msg' => 'success'], 200);
        }

        return response()->json(['status' => 'error', 'data' => [], 'msg' => 'Something went wrong. Please try again!'], 400);
    }

    public function productDislike(Request $request)
    {
        $product = Product::with(['likes'])->whereId($request->product_id)->first();

        if ($product) {
            $data = [
                'product_id' => $request->product_id,
                'user_id' => Auth::guard('sanctum')->check() ? Auth::guard('api')->user()->id : mt_rand(1, 10),
            ];
            $productDisliked = ProductDislike::where(['product_id'=>$data['product_id'], 'user_id'=>$data['user_id']])->first();
            if ($productDisliked) {
                $productDisliked->delete();
            } else {
                $productDisliked = ProductDislike::create($data);
            }
            return response()->json(['status' => 'success', 'data' => [], 'msg' => 'success'], 200);
        }

        return response()->json(['status' => 'error', 'data' => [], 'msg' => 'Something went wrong. Please try again!'], 400);
    }
}
