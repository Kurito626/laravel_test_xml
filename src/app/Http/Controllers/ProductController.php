<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Product::select('vendor')->distinct()->orderBy('vendor')->get();

        $products = Product::with(['category', 'extrop'])
            ->when($request->vendor, function($query) use ($request) {
                return $query->where('vendor', $request->vendor);
            })
            ->orderBy('name')
            ->paginate(10);

        return view('products.index', compact('products', 'vendors'));

    }
}
