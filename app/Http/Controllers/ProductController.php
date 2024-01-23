<?php
namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function index(){
        $categoryCounts = Product::groupBy('category')->selectRaw('category,count(*) as count')->get();
        //dd($categoryCounts);

        return inertia::render('dashboard',['products' =>  Product::paginate(5),'users' =>  User::paginate(6),'categoryCounts'=>$categoryCounts]);
    }

    public function create(){
        return inertia::render('create');
    }

    public function productlist(){
        //$data = Product::latest();
        return inertia::render('productslist',['products' =>  Product::latest()->filter(request(['search','filter']))->paginate(6)]);
    }

    public function register(){
        return inertia::render('register');
    }

    public function login(){
        return inertia::render('login');
    }

    public function addproduct(){
        return inertia::render('addproducts');
    }

    //Store Product Data
    public function store(Request $request){
        //dd($request->all());
        $formFields = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'datetime' => 'required',
        ]);

        if($request->hasfile('image')){

            $formFields['image'] = $request->file('image')->store('productImage','public');
        }
        Product::create($formFields);


        return redirect::route('productlist')->with('message','Listing Added Succesfully!');
    }

    public function edit(Product $product){
        return inertia::render('editproduct', ['product'=> $product]);
    }

    public function update(Request $request,Product $product){
        $formFields = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'datetime' => 'required',
        ]);

        if($request->hasfile('image')){
            $formFields['image'] = $request->file('image')->store('image','public');
        }

        $product->update($formFields);
        return back()->with('message','Listing Updated Succesfully!');
        //return back()->with('message','Listing Updated Succesfully!');
        }

    //Delete Listing
    public function delete(Product $product){
        $product->delete();
        return Redirect::route('productlist')->with('message','Listing Deleted Succesfully');

    }

    // public function store(Request $request){
    //     $formFields = $request->validate([
    //         'name' => ['required','max:255'],
    //         'email' => ['required','email',Rule::unique('customers')],
    //         'phone' => ['required','max:14','min:10',Rule::unique('customers')],
    //     ]);

    //     Customer::create($formFields);

    //     return Redirect::route('customers.index');
    // }
}
