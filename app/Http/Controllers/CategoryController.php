<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Category::all();
        return view('admin.category', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name'=> 'required|unique:categories',
            'category_name_bn'=> 'required|unique:categories',
            'category_slug'=>'required|unique:categories'
        ]);
        $categoryName = $request->post('category_name');
        $categoryNameBn = $request->post('category_name_bn');
        $categorySlug = $request->post('category_slug');

        $model = new Category;
        $model->category_name = $categoryName;
        $model->category_name_bn = $categoryNameBn;
        $model->category_slug = $categorySlug;
        $model->save();

        $request->session()->flash('message', "Category Inserted Successfully");
        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $result['data'] = Category::where([ 'id' => $id ])->first();
        return view('admin.category_edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'=> 'required|unique:categories,category_name,'.$request->post('id'),
            'category_name_bn'=> 'required|unique:categories,category_name_bn,'.$request->post('id'),
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id')
        ]);
        $categoryName = $request->post('category_name');
        $categoryNameBn = $request->post('category_name_bn');
        $categorySlug = $request->post('category_slug');

        $model = category::find($request->post('id'));

        if($model){
            $model->category_name = $categoryName;
            $model->category_name_bn = $categoryNameBn;
            $model->category_slug = $categorySlug;
            $model->save();

            $request->session()->flash('message', "Category updated");
            
        }else{
            $request->session()->flash('error_message', "Data not found or Something went wrong");
        }
        return redirect('admin/category/edit/'.$request->post('id'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Category::destroy($id);
        $request->session()->flash('message', "Category deleted Successfully");
        return redirect('admin/category');
    }
}
