<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class CartController extends Controller
{
        // Aggiunge un articolo al carrello
        public function add($id)
{
    $article = Article::findOrFail($id); // recupera l'articolo dal DB
    
    // Verifica se title è presente
    if (!$article->title) {
        return redirect()->back()->with('error', 'Errore: il titolo dell\'articolo non è stato trovato.');
    }

    // recupera il carrello esistente dalla sessione, oppure array vuoto
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        // se l'articolo è già nel carrello, aumenta la quantità
        $cart[$id]['quantity']++;
    } else {
        // altrimenti aggiungilo con quantità 1
        $cart[$id] = [
            "name" => $article->title,  // Usa title per il nome
            "price" => $article->price,
            "quantity" => 1
        ];
    }

    // salva il carrello aggiornato nella sessione
    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Articolo aggiunto al carrello!');
}

    
        // Mostra il contenuto del carrello
        public function view()
        {
            $cart = session()->get('cart', []);
            
            // calcola il totale
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);
    
            return view('cart', compact('cart', 'total'));
        }
    
        // Rimuove un articolo dal carrello
        public function remove($id)
        {
            $cart = session()->get('cart', []);
    
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
    
            return redirect()->route('cart.view')->with('success', 'Articolo rimosso dal carrello.');
        }
}
