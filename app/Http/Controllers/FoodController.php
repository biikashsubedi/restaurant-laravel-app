<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Food;
use PhpParser\Node\Stmt\Return_;
use function GuzzleHttp\Promise\all;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::latest()->paginate(10);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'required:mines:png,jpeg, jpg',
            'category_id' => 'required'
        ]);

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/food-images');
        $image->move($destinationPath, $name);

        $food = Food::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'image' => $name
        ]);
        $food->save();
        return redirect('/food')->with('msg', 'Food Sucessfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);
        return view('food.detail', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
//            'image' => 'required:mines:png,jpeg, jpg',~
            'category_id' => 'required'
        ]);

        $food = Food::find($id);
        $name = $food->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/food-images');
            $image->move($destinationPath, $name);
        }

//        $food->name = $request->get('name');
//        $food->description = $request->get('description');
//        $food->price = $request->get('price');
//        $food->category_id = $request->get('category_id');
//        $food->image = $name;
//        $food->save();

        $food->update([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'image' => $name
        ]);
        $food->save();

        return redirect('/food')->with('msg', 'Food Sucessfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect('/food')->with('msg', 'Food Sucessfully Deleted');
    }

    public function listFood()
    {
         $categories = Category::with('food')->get();
         return view('food.list', compact('categories'));
    }
}
