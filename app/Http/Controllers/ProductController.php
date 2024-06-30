<?php

namespace App\Http\Controllers;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(public ProductService $productService)
    {
    }

    public function index(): View
    {
        return view('products.index', [
            'products' => $this->productService->getWithPagination(auth()->user(), $search = request()->filled('search') ? request()->search : null, 10),
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        try {
            $productDTO = ProductDTO::fromRequest($request->all(), auth()->id());
            $this->productService->store($productDTO);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        if (auth()->user()->cannot('update', $product)) {
        abort(403);
    }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        if (auth()->user()->cannot('update', $product)) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        try {
            $productDTO = ProductDTO::fromRequest($request->all(), $product->user_id);
            $this->productService->update($productDTO, $product);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if (auth()->user()->cannot('delete', $product)) {
            abort(403);
        }
        try {
            $this->productService->delete($product);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
