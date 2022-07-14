<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function AddCategory(Request $req)
    {
        $label = $req->label;
        $id = $req->resto_id;
        $categ = new Category;
        $categ->label = $label;
        $categ->resto_id = $id;
        $check = Category::where("label", $label)->first();
        if ($check) {
            return response(json_encode(["type" => "error", "message" => "This category is already exists"]), 500);
        }

        $categ->save();
        return response(json_encode(["type" => "success", "message" => "Added Successfully !"]), 200);
    }

    public function DeleteCategory($id)
    {
        $cat = Category::where("id", $id)->first();
        if ($cat) {
            $cat->delete();
            return response(json_encode(["type" => "success", "message" => "Deleted Successfully !"]), 200);
        }
    }
}
