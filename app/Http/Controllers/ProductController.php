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
                'category' => "bail|required",
                'picture' => "bail|required",
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $label = $req->label;

            $resto_id = $req->resto_id;
            $price = $req->price;
            $statut = 1;
            $description = $req->description;
            $category_id  = $req->category;
            $supp = 0;
            $topping = 0;
            $sauce = 0;
            $drink = 0;
            if ($req->has("supplement")) {
                $supp = 1;
            }
            if ($req->has("topping")) {
                $topping = 1;
            }
            if ($req->has("sauce")) {
                $sauce = 1;
            }
            if ($req->has("drink")) {
                $drink = 1;
            }
            $product = new Product;
            if ($req->hasFile("picture")) {
                $file = $req->file("picture");
                $filename = time() . "." . $file->getClientOriginalExtension();
                $product->picture = $filename;
            }
            $product->label = $label;
            $product->description = $description;
            $product->resto_id = $resto_id;
            $product->category_id = $category_id;
            $product->price = $price;
            $product->statut = $statut;
            $product->have_supplement = $supp;
            $product->have_drinks = $drink;
            $product->have_sauces = $sauce;
            $product->have_toppings = $topping;
            if ($product->save()) {
                $file->move("uploads/products", $filename);
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
                'category' => "bail|required",
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $product = Product::where("product_id", $id)->first();

            $label = $req->label;
            $price = $req->price;
            $statut = $req->statut;
            $category = $req->category;
            $description = $req->description;
            if ($req->topping == "") {
                $product->have_toppings = 0;
            } else {
                $product->have_toppings = 1;
            }

            if ($req->supplement == "") {
                $product->have_supplement = 0;
            } else {
                $product->have_supplement = 1;
            }

            if ($req->sauce == "") {
                $product->have_sauces = 0;
            } else {
                $product->have_sauces = 1;
            }

            if ($req->drink == "") {
                $product->have_drinks = 0;
            } else {
                $product->have_drinks = 1;
            }

            if ($req->hasFile("picture")) {
                if ($product->picture != "") {
                    unlink(base_path() . "/public/uploads/products/$product->picture");
                }
                $file = $req->file("picture");
                $filename = time() . "." . $file->getClientOriginalExtension();
                $product->picture = $filename;
                $file->move("uploads/products", $filename);
            }

            if ($product) {
                $product->label = $label;
                $product->price = $price;
                $product->category_id = $category;
                $product->statut = $statut;
                $product->description = $description;
                if ($product->save()) {
                    return response(json_encode(["type" => "success", "message" => "Updated"]), 200);
                }
            }

            // return response(json_encode(["type" => "error", "message" => "Product not found"]), 500);
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
                if ($product->picture != "") {
                    unlink(base_path() . "/public/uploads/products/$product->picture");
                }
                if ($product->delete()) {
                    return response(json_encode(["type" => "success", "message" => "Product deleted successfully ! "]), 200);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "This product doesn't exist in our records"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
