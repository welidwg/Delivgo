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
        $check = Category::where("label", $label)->where("resto_id", $id)->first();
        if ($check) {
            return response(json_encode(["type" => "error", "message" => "Cette catégorie est déjà existante"]), 500);
        }

        $categ->save();
        return response(json_encode(["type" => "success", "message" => "Ajoutée avec succès !"]), 200);
    }

    public function Update(Request $req, $id)
    {
        try {
            $supp = Category::where("id", $id)->first();
            $supp->label = $req->label;

            if ($supp->save()) {
                return \response(json_encode(["type" => "success", "message" => "Mis à jour"]), 200);
            } else {
                return \response(json_encode(["type" => "error", "message" => "Erreur inconnue"]), 500);
            }
        } catch (\Throwable $th) {
            return \response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    public function DeleteCategory($id)
    {
        $cat = Category::where("id", $id)->first();
        if ($cat) {
            $cat->delete();
            return response(json_encode(["type" => "success", "message" => "Supprimée avec succès !"]), 200);
        }
    }
}
