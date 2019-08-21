<?php

namespace App\Http\Controllers\Requisiciones;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisiciones\ArticleRequest;
use App\Models\requisiciones\Article;
use App\Models\requisiciones\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('requisiciones.articles.search', compact('articles'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return datatables()
                ->eloquent(Article::select('id', 'name', 'trademark', 'unit', 'cost', 'tariff', 'category', 'imagen'))
                ->addColumn('btn', 'requisiciones.articles.actions')
                ->addColumn('imagen', 'requisiciones.articles.imagen')
                ->rawColumns(['btn', 'imagen'])
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::select('id', 'name')->get();

        return view('requisiciones.articles.index', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->only(['name', 'trademark', 'unit', 'provider_id', 'cost', 'tariff', 'category', 'description']));

        //IMAGEN
        if ($request->file('imagen')) {

            $path = Storage::disk('public')->put('articles', $request->file('imagen'));

            $article->fill(['imagen' => asset($path)])->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $providers = Provider::select('id', 'name')->get();

        return view('requisiciones.articles.edit', compact('article', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->only(['name', 'trademark', 'unit', 'provider_id', 'cost', 'tariff', 'category', 'description']));

        //IMAGEN
        //validamos que exista la imagen, para eliminarla antes de actualizarla
        if (Storage::disk('public')->exists($article->imagen)) {
            Storage::disk('public')->delete($article->imagen);
        }
        //actualizamos la iamgen
        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('articles', $request->file('imagen'));
            $article->fill(['imagen' => $path])->save();
        }
        //consultamos toods los articulos
        $articles = Article::all();

        return view('requisiciones.articles.search', compact('articles'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $articles = Article::where('name','like','%'.$query.'%')
                            ->where('status', 1)
                             ->where('category', $request->category)
                            ->get();
        return response()->json($articles);
    }

    // public function desactivar($id)
    // {
    //     dd($id);
    //     $article = Article::findOrFail($id);

    //     $article->state = !$article->state;

    //     $article->save();

    //     return view('requisiciones.articles.search');
    // }
}
