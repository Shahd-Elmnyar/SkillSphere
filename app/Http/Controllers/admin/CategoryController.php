<?php

namespace App\Http\Controllers\admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Categorie::orderBy('id', 'DESC')->paginate(10);
        return view('admin/categories/index')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        Categorie::create([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        $request->session()->flash('msg', 'row added successfully');
        return back();
    }
    public function delete(Categorie $categorie, Request $request)
    {
        try {
            $isDeleted = $categorie->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = 'can not delete this category';
        }
        $request->session()->flash('msg', $msg);
        return back();
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:50',
            ' ' => 'required|string|max:50',
        ]);
        //  dd($request->id);
        Categorie::findOrFail($request->id)->update([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }
    public function toggle(Categorie $categorie)
    {
        $categorie->update([
            'active' => !$categorie->active,
        ]);
        return back();
    }
}
