<?php

namespace App\Http\Controllers;

use App\Models\AtmCategory;
use Illuminate\Http\Request;

class AtmCategoryController extends Controller
{
    // Exibe uma lista das categorias
    public function index()
    {
        $categories = AtmCategory::all();
        return response()->json($categories);
    }

    // Salva uma nova categoria no banco de dados
    public function store(Request $request)
    {
        $category = AtmCategory::create($request->all());
        return response()->json($category, 201);
    }

    // Mostra uma categoria específica
    public function show(AtmCategory $category)
    {
        return response()->json($category);
    }

    // Atualiza uma categoria específica no banco de dados
    public function update(Request $request, AtmCategory $category)
    {
        $category->update($request->all());
        return response()->json($category);
    }

    // Remove uma categoria específica do banco de dados
    public function destroy(AtmCategory $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
