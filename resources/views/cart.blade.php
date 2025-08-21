<x-layout>

    <h1 class="mb-4 text-center">I Tuoi Ordini</h1>
    
    @if(count($cart) > 0)
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                    <th>Subtotale</th>
                    <th>Rimuovi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>€{{ number_format($item['price'], 2, ',', '.') }}</td>
                        <td>€{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h3 class="font-weight-bold">Totale: €{{ number_format($total, 2, ',', '.') }}</h3>
        </div>

        <!-- Centrare e ingrandire il pulsante Vai al pagamento -->
        <div class="text-center mt-5">
            <button class="btn btn-success btn-lg px-4 py-2 shadow rounded-pill" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                <i class="bi bi-credit-card me-2"></i> Vai al pagamento
            </button>
        </div>
        
        <!-- Modale Bootstrap -->
            <div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="comingSoonModalLabel">Attenzione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body text-center">
                    🚧 Funzionalità da implementare 🚧
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
                </div>
            </div>
            </div>
        @else
        <div class="alert alert-warning mt-4">
            Il carrello è vuoto.
        </div>
    @endif
    
    <!-- Miglioramento dell'ancora "Torna agli articoli" -->
    <a href="{{ route('article.index') }}" class="btn btn-outline-primary mt-4" style="text-decoration: none; font-weight: bold;">
        <i class="bi bi-arrow-left-circle"></i> Torna agli articoli
    </a>

</x-layout>
