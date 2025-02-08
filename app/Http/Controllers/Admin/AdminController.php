<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Returns;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        return view('pages.admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('pages.admin.manage_user',[
            'users' => $users
            ]);
    }

    public function createUser()
    {
        return view('pages.admin.create_user');
    }

    public function storeUser(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->hasFile('image')) {
            // Store the image in 'user_images' folder under 'public' storage
            $imagePath = $request->file('image')->store('user_images', 'public');
        } else {
            $images = ["/assets/image1.jpeg", "/assets/image2.jpeg",  "/assets/image3.jpeg","/assets/image4.jpeg","/assets/image5.jpeg","/assets/image6.jpeg","/assets/image7.jpeg","/assets/image8.jpeg","/assets/image9.jpeg","/assets/image10.jpeg"];
            $imagePath = $images[array_rand($images)];

        }

        // Create a new user instance and save it to the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['email']),
            'role' => $validatedData['role'],
            'image' => $imagePath,
        ]);

        if ($user) {
            return redirect()->back()->with('success', 'User Created Successfully');
        } else {
            return redirect()->back()->with('error', 'User Not Created Successfully');
        }



    }
    public function showUser(User $user)
    {
        return view('pages.admin.show_user',[
            'user' => $user
        ]);
    }

    public function editUser(User $user)
    {
        return view('pages.admin.edit_user',[
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => '',
            'role' => 'sometimes',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dataToUpdate = [];

        if (isset($validatedData['name'])) {
            $dataToUpdate['name'] = $validatedData['name'];
        }

        if (isset($validatedData['email'])) {
            $dataToUpdate['email'] = $validatedData['email'];
        }

        if (isset($validatedData['password'])) {
            $dataToUpdate['password'] = Hash::make($validatedData['password']);
        }

        if (isset($validatedData['role'])) {
            $dataToUpdate['role'] = $validatedData['role'];
        }

        if ($request->hasFile('image')) {
            $dataToUpdate['image'] = $request->file('image')->store('user_images', 'public');
        }

        $data = $user->update($dataToUpdate);

        if ($data) {
            return redirect()->back()->with('success', 'User Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'User Not updated Successfully');
        }

    }

    public function destroyUser(User $user)
    {
        $data= $user->delete();

        if ($data) {
            return redirect('/admin/users/manage')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'User Not Deleted Successfully');
        }

    }



    public function manageProducts()
    {
        return view('pages.admin.manage_products');
    }

    public function createProduct()
    {
        return view('pages.admin.create_product');
    }


    public function storeProduct(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0', // Ensure selling price is greater than or equal to cost price
            'quantity' => 'required|integer|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100', // Optional field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'low_stock'=>'required'
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $validatedData['image'] = '/storage/' . $imagePath;
        }

        // Create the product
        $product = Product::create($validatedData);

        if ($product) {
            return redirect()->back()->with('success', 'Product Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Product Not Added Successfully');
        }
    }



    public function showProduct(Product $product)
    {
        return view('pages.admin.show_product',[
            'product' => $product
        ]);
    }

    public function editProduct(Product $product)
    {
        return view('pages.admin.edit_product',[
            'product' => $product
        ]);
    }

    public function updateProduct(Request $request, Product $product)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'selling_price' => 'sometimes|numeric|min:0',
            'cost_price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'tax_rate' => 'sometimes|numeric|min:0|max:100',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'low_stock'=>'sometimes'
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Store the new image and save the path
            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $validatedData['image'] = '/storage/' . $imagePath;
        }

        // Update the product with validated data
        $data = $product->update($validatedData);

        // Redirect or return a response
        if ($data) {
            return redirect()->back()->with('success', 'Product Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Product Not updated Successfully');
        }


    }

    public function destroyProduct(Product $product)
    {
        $data= $product->delete();

        if ($data) {
            return redirect('/admin/products/manage')->with('success', 'Product deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Product Not Deleted Successfully');
        }

    }


    public function manageSales()
    {
        return view('pages.admin.manage_sales');
    }

    public  function showSale(Sale $sale)
    {
        return view('pages.admin.show_sale',[
            'sale' => $sale
        ]);
    }

    public function returns()
    {

        $total = Returns::with('product')
        ->get()
            ->reduce(function ($carry, $return) {
                return $carry + ($return->quantity * $return->price_at_purchase * (100 + $return->product->tax_rate) / 100);
            }, 0);

        // Paginate the data
        $data = Returns::with('product')->paginate(10);

        // Return to the view
        return view('pages.admin.show_returns', [
            'returns' => $data,
            'total' => $total
        ]);
    }


}
