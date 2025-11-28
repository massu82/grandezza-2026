<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%'.$request->q.'%')
                    ->orWhere('sku', 'like', '%'.$request->q.'%');
            });
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->integer('categoria'));
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->integer('estado'));
        }

        $products = $query->orderByDesc('created_at')->paginate(15)->withQueryString();
        $categorias = Category::pluck('nombre', 'id')->toArray();

        return view('admin.products.index', compact('products', 'categorias'));
    }

    public function create()
    {
        $categorias = Category::pluck('nombre', 'id')->toArray();
        $product = new Product();

        return view('admin.products.create', compact('categorias', 'product'));
    }

    public function store(ProductRequest $request)
    {
        $data = $this->mapData($request);
        Product::create($data);

        return redirect('/admin/products')->with('success', 'Producto creado.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categorias = Category::pluck('nombre', 'id')->toArray();

        return view('admin.products.edit', compact('product', 'categorias'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $this->mapData($request);
        $product->update($data);

        return redirect('/admin/products')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Producto eliminado.');
    }

    protected function mapData(ProductRequest $request): array
    {
        return [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_larga' => $request->descripcion_larga,
            'precio' => $request->precio,
            'precio_promocion' => $request->precio_promocion,
            'porcentaje_descuento' => $request->porcentaje_descuento,
            'categoria_id' => $request->categoria_id,
            'tipo' => $request->tipo,
            'pais' => $request->pais,
            'region' => $request->region,
            'uva' => $request->uva,
            'anada' => $request->anada,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'estado' => $request->estado ?? 1,
            'tags' => $request->tags,
            'imagen_principal' => $request->imagen_principal,
            'galeria' => $this->decodeJson($request->galeria),
            'destacado' => (bool) $request->destacado,
        ];
    }

    protected function decodeJson($value): ?array
    {
        if (!$value) {
            return null;
        }

        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }
}
