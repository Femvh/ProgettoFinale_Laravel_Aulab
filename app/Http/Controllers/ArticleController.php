<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware():array
    {
        return[
            new Middleware('auth', only:['create']),
        ];
        
    }
    public function create (){
        return view('article.create');
        
    }
    
    public function index()
    {
        $sort = request('sort');
        $queryValue = request('query');
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');
    
        $query = Article::where('is_accepted', true);
    
        // Filtro per parola chiave
        if ($queryValue) {
            $query->where('title', 'like', "%{$queryValue}%")
                ->orWhere('description', 'like', "%{$queryValue}%");
        }
    
        // Filtro prezzo minimo
        if (!is_null($minPrice) && $minPrice !== '') {
            $query->where('price', '>=', floatval($minPrice));
        }
    
        // Filtro prezzo massimo
        if (!is_null($maxPrice) && $maxPrice !== '') {
            $query->where('price', '<=', floatval($maxPrice));
        }
    
        // Ordinamento
        switch ($sort) {
            case 'descByDate':
                $query->orderBy('created_at', 'desc');
                break;
            case 'ascByDate':
                $query->orderBy('created_at', 'asc');
                break;
            case 'descByPrice':
                $query->orderBy('price', 'desc');
                break;
            case 'ascByPrice':
                $query->orderBy('price', 'asc');
                break;
            case 'ascByAlpha':
                $query->orderBy('title', 'asc');
                break;
            case 'descByAlpha':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
    
        $articles = $query->paginate(12);
    
        return view('article.index', compact('articles'));
    }
    

    
    
    public function show(Article $article){
        return  view('article.show', compact('article'));
    }
    
    public function byCategory(Category $category){
        $articles =$category->articles->where('is_accepted', true);
        return view('article.byCategory', compact('articles', 'category'));
    }
    
    public function edit(Article $article){
        return view('article.edit', compact('article'));
    }
    
    public function update(Request $request  ,Article $article){
        $validated = $request->validate([
            'title'=>'required|min:5',
            'description'=>'required|min:10',
            'price'=>'required|numeric',
            
        ]);
        
        $article->update(['title'=>$request->title,'description'=>$request->description,'price'=>$request->price,'category'=>$request->category ]);
        return redirect()->route('article.index');
    }
    
    public function destroy(Article $article){
        
        $article->delete();
        
        return redirect()->route('article.index');
    }
    public function myArticles()
    {
        $articles = Article::where('user_id', auth()->id())->latest()->paginate(12);
        
            return view('article.my', compact('articles'));
    }
}
