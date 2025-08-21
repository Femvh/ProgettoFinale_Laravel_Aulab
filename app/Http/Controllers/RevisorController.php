<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\BecomeRevisor;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::where('is_accepted', null)->first();
        return view('revisor.index', compact('article_to_check'));
    }

    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        return redirect()->back()->with('accepted', 'Articolo accettato con successo!');
    }

    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        return redirect()->route('revisor.index')->with('rejected', 'Articolo rifiutato correttamente.');
    }

    public function rejected()
    {
        $rejectedArticles = Article::where('is_accepted', false)->latest()->paginate(10);
        return view('revisor.rejected', compact('rejectedArticles'));
    }

    public function becomeRevisor()
    {
        Mail::to('admin@biteandbuy.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('work')->with('message', 'Richiesta inviata correttamente');
    }

    public function makeRevisor(User $user)
    {
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }
    public function revertToRevision(Article $article)
{
    $article->is_accepted = null;
    $article->save();

    return redirect()->back()->with('message', 'Articolo rimesso in revisione!');
}

}
