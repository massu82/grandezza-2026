<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

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

        $products = $query
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();
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

        if ($request->hasFile('imagen_principal')) {
            $data['imagen_principal'] = $this->imageService->process($request->file('imagen_principal'), 'products');
        }

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

        if ($request->hasFile('imagen_principal')) {
            if ($product->imagen_principal) {
                $this->imageService->delete($product->imagen_principal, 'products');
            }
            $data['imagen_principal'] = $this->imageService->process($request->file('imagen_principal'), 'products');
        }

        $product->update($data);

        return redirect('/admin/products')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        if ($product->imagen_principal) {
            $this->imageService->delete($product->imagen_principal, 'products');
        }
        $product->delete();

        return redirect()->back()->with('success', 'Producto eliminado.');
    }

    public function inlineUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'presentation' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'estado' => ['required', 'integer', 'in:0,1'],
        ]);

        $product->update([
            'presentation' => $validated['presentation'],
            'precio' => $validated['precio'],
            'stock' => $validated['stock'],
            'estado' => $validated['estado'],
            'slug' => Product::generateSlug($product->nombre, $validated['presentation']),
        ]);

        return response()->json([
            'message' => 'Actualizado',
            'presentation' => $product->presentation,
            'precio' => $product->precio,
            'stock' => $product->stock,
            'estado' => $product->estado,
        ]);
    }

    public function duplicate(Product $product)
    {
        $categorias = Category::pluck('nombre', 'id')->toArray();
        $copy = $product->replicate(['slug', 'sku', 'created_at', 'updated_at', 'deleted_at']);
        $copy->nombre = $product->nombre.' (copia)';

        return view('admin.products.create', [
            'categorias' => $categorias,
            'product' => $copy,
        ]);
    }

    protected function mapData(ProductRequest $request): array
    {
        return [
            'nombre' => $request->nombre,
            'presentation' => $request->presentation,
            'slug' => Product::generateSlug($request->nombre, $request->presentation),
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
            'galeria' => $this->handleGallery($request),
            'destacado' => (bool) $request->destacado,
        ];
    }

    protected function handleGallery(Request $request): ?array
    {
        $gallery = [];

        // mantener existente si no se envían nuevos archivos
        if (!$request->hasFile('galeria') && $request->galeria === null && $request->route('product')) {
            $existing = $request->route('product')->galeria ?? [];
            return $existing ?: null;
        }

        if ($request->hasFile('galeria')) {
            // borrar existentes si hay nuevos
            if ($request->route('product') && $request->route('product')->galeria) {
                foreach ($request->route('product')->galeria as $img) {
                    $this->imageService->delete($img, 'products');
                }
            }

            foreach ($request->file('galeria') as $file) {
                $gallery[] = $this->imageService->process($file, 'products');
            }
        }

        return $gallery ?: null;
    }
}
