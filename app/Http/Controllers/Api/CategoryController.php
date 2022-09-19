<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Category::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
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
        $this->validate($request, [
            'category_name' => 'required',
        
        ]);
 
        $category = new Category();
        $category->category_name = $request->category_name;
 
        if ($category->save())
            return response()->json([
                'success' => true,
                'data' => $category->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'category not added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'category not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $category->toArray()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'category not found'
            ], 400);
        }
 
        $updated = $category->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'category can not be updated'
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'category not found'
            ], 400);
        }
 
        if ($category->delete()) {
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'category can not be deleted'
            ], 500);
        }
    }



}
