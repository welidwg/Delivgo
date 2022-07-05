<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function AddProduct(Request $req)
    {

        try {
            $validate = Validator::make($req->all(), [
                'label' => "bail|required",
                'resto_id' => "bail|required",
                'price' => "bail|required",
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $label = $req->json("label");
            $resto_id = $req->json("resto_id");
            $price = $req->json("price");
            $statut = $req->json("statut");
            $product = new Product;
            $product->label = $label;
            $product->resto_id = $resto_id;
            $product->price = $price;
            $product->statut = $statut;
            if ($product->save()) {
                return response(json_encode(["type" => "success", "message" => "Product created successfully"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function UpdateProduct(Request $req, $id)
    {

        try {
            $validate = Validator::make($req->all(), [
                'label' => "bail|required",
                'price' => "bail|required",
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $label = $req->json("label");
            $price = $req->json("price");
            $statut = $req->json("statut");
            $product = Product::where("product_id", $id)->first();
            if ($product) {
                $product->label = $label;
                $product->price = $price;
                $product->statut = $statut;
                if ($product->save()) {
                    return response(json_encode(["type" => "success", "message" => "Product updated successfully"]), 200);
                }
            }
            return response(json_encode(["type" => "error", "message" => "Product not found"]), 500);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function GetProducts($resto_id)
    {
        try {
            $resto = User::where("user_id", $resto_id)->where("type", 2)->first();
            if ($resto) {
                $products = Product::where("resto_id", $resto_id)->get();
                if ($products->count() > 0) {
                    return response(json_encode($products), 200);
                }
                return response(json_encode(["type" => "error", "message" => "This restaurant have no article yet"]), 500);
            } else {
                return response(json_encode(["type" => "error", "message" => "This restaurant doesn't exist in our records"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function GetAllProducts()
    {
        # code...
        $products = Product::with('resto')->get();
        if ($products->count() > 0) {
            return response(json_encode($products), 200);
        }
        return response(json_encode(["type" => "error", "message" => "There is no products yets"]), 500);
    }

    public function DeleteProduct($id)
    {
        try {
            $product = Product::where("product_id", $id)->first();
            if ($product) {
                if ($product->delete()) {
                    return response(json_encode(["type" => "success", "message" => "Product deleted successfully ! "]), 500);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "This product doesn't exist in our records"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
