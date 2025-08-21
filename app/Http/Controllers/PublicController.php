<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\ContactMail;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    
    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
        
    }
    public function homepage()
    {
        $news = Http::get('https://api.jikan.moe/v4/anime/')->json();
        
        $news = Arr::map($news['data'], function ($item){
            return [
                'title'=>$item['title'],
                'images'=>$item['images']['jpg']['large_image_url'],
                'synopsis'=>$item['synopsis']
            ];
        });
        
        $news = collect($news);
        $news = $news->shuffle()->take(6);
        
        
        
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('articles','news'));
    }
    
    public function contact(){
        return view('contact');
    }

    public function about() {
        return view('about-us');
    }
    
    public function privacy(){
        return view('privacy');
    }
    
    public function work(){
        
        
        
        return view('workwithus');
    }
    public function searchArticles(Request $request){
        
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->paginate(10);
        return view('article.searched', ['articles' => $articles, 'query' => $query]);
        
    }
    public function setLocale($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
    
    
    public function contactmail(Request $request){
        
        $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'required|string',
        ]);
        
        $emailData = [
            'title' => $request->title,
            'email' => $request->email,
            'description' => $request->description,
        ];
        
        
        Mail::to('assistenzaBiteandBuy@gmail.com')->send(new ContactMail($emailData));
        
        return redirect()->back()->with('success', 'Messaggio inviato con successo!');
    }
    
}
