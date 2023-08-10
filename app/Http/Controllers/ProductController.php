<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function accueil()
    {
        $product = products::get();
        return view('products.accueil', ['data' => $product]);
    }

    public function getCategories()
{
    $categories = Category::all(); // Récupérez toutes les catégories depuis la base de données
    return $categories;
}

    public function add()
    {
        $categories = $this->getCategories(); // Appeler la fonction pour récupérer les catégories
        return view('products.form', compact('categories'));
       
    }

    public function save(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');

            // Vérifier si le type de fichier est autorisé (PNG, JPEG ou JPG)
            if ($file->getClientOriginalExtension() === 'png' ||
                in_array($file->getClientOriginalExtension(), ['jpeg', 'jpg'])) {

                // Générer un nom de fichier aléatoire pour éviter les conflits
                $randomFileName = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Déplacer le fichier vers le dossier "public/images"
                $file->move(public_path('images'), $randomFileName);

                $filepath = 'images/' . $randomFileName;
                
            } 
        } 

        $data = [
            'item_code' => $request->item_code,
            'productname' => $request->productname,
            'categoryId' => $request->categoryId,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $filepath,

        ];

        
        products::create($data);

        return redirect()->route('products');
    }


     public function edit($id)
    {
        $product = products::find($id);
        $categories = category::all();

        return view('products.form', ['product' => $product,
                                       'categories' => $categories    ]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'item_code' => $request->item_code,
            'productname' => $request->productname,
            'category' => $request->id_category,
            'price' => $request->price
        ];

        products::find($id)->update($data);

        return redirect()->route('products');
    }

    public function delete($id)
    {
        products::find($id)->delete();

        return redirect()->route('products');
    }


    public function getProductDetails($id)
    {
        $product = products::find($id);
        return view('products.product_details', ['product' => $product]);
    }

    public function test(Request $request)
    {
        $query = $request->input('search');
        
        $products = Products::where('productname', 'like', '%'.$query.'%')
                        ->paginate(10);
        
        return view('products.search')->with('products', $products);
    }

  

}
