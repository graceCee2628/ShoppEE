<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Product;

use App\Cart;

use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //TO SAVE DATA TO THE DB
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'pname' => 'required',
            'qty' => 'required',
            'price'=> 'required',
            'desc' => 'required',
            'pimage'=> 'required|image|max:2048'
        ]);

        $pro = new Product;
        $pro->name = $request->pname;
        $pro->qty = $request->qty;
        $pro->price = $request->price;
        $pro->description = $request->desc;
        $pro->product_code=0;

        if($files = $request->pimage){
            $destination='images';
            $new_name= rand().'.'.$files->getClientOriginalName();
            $files->move(public_path($destination),$new_name);
            // $path=public_path().'/'.$destination.'/'.$new_name;
            $pro->image=$new_name;
            $pro->save();

            $product = Product::orderBy('created_at', 'desc')->first();
            $id = $product->id;
            $date = preg_replace("/[\s-:]/", "", $pro->created_at); 
            $pro->product_code = 'SKU:'.$id.$date;
            $pro->save();

            return 'success!';
        }else{
            return 'failed to save the data.';
        }

    }

    //TO VIEW DATA FOR EDIT PURPOSES
    public function edit_data($id){
        
        $products = Product::findOrFail($id);

        return view ('admin.edit')->with('product',$products);
    }

    //TO UPDATE DATA 
    public function update(Request $request){
        
        $image_name = $request->hidden_image;
        $image = $request->file('pimage');
        if($image !=''){
            $request->validate([
                'pname' => 'required',
                'qty' => 'required',
                'price'=> 'required',
                'desc' => 'required',
                'pimage'=> 'required|image|max:2048'
            ]);
            $image_name= rand().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'),$image_name);
        }
        else{
            $request->validate([
                'pname' => 'required',
                'qty' => 'required',
                'price'=> 'required',
                'desc' => 'required'
            ]);
        }

        $form_data=array(
            'name' => $request->pname,
            'qty' => $request->qty,
            'price'=> $request->price,
            'description'=> $request->desc,
            'image' => $image_name
        );

        Product::whereId($request->prod_id)->update($form_data);
        return 'success';
    } 

    //TO FECTH DATA FROM THE DATABASE
    public function show(){
        $product = Product::all()->toArray();

        return view ('admin.index')->with('products',$product );
    }

    //TO DELETE
    public function delete($id){
        
        $products = Product::find($id);
        $products->delete();
    }    



}
