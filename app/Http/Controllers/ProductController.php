<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data   = Product::paginate(10);
        return view('product.index', compact('data'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $requests = $request->all();
        
        $pd = Product::create($requests);
        if($pd){
            return redirect('product')->with('status', 'Done created!');
        }

        return redirect('product')->with('status', 'False created !');
    }

    public function edit($id)
    {
        $data = Product::find($id);
        return view('product.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $d = Product::find($id);
        if ($d == null){
            return redirect('product/'. $id)->with('status', 'Data not found !');
        }

        $req = $request->all();

        $data = Product::find($id)->update($req);
        if($data){
            return redirect('product')->with('status', 'Done edit data !');
        }

        return redirect('product/edit/'.$id)->with('status', 'False edit data!');
        
    }

    public function delete($id)
    {
        $data = Product::find($id);
        if ($data == null) {
            return redirect('product')->with('status', 'Data not found !');
        }
        
        $delete = $data->delete();
        if ($delete) {
            return redirect('product')->with('status', 'Done delete data !');
        }
        return redirect('product')->with('status', 'False delete data !');
    }

}
