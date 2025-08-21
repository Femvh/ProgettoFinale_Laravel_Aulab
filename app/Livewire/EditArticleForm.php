<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\GoogleVisionLabelImage;

class EditArticleForm extends Component
{
    use WithFileUploads;

    public $article;
    public $title, $description, $price, $category;

    public $images = []; // immagini già salvate
    public $temporary_images = []; // nuove immagini Livewire
    public $newImages = []; // immagini pronte per salvataggio

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->title = $article->title;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->category = $article->category_id;
        $this->images = $article->images->toArray();
    }

    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6'
        ]);

        foreach ($this->temporary_images as $image) {
            $this->newImages[] = $image;
        }
    }

    public function removeNewImage($key)
    {
        if (array_key_exists($key, $this->newImages)) {
            unset($this->newImages[$key]);
        }
    }

    public function removeExistingImage($imageId)
    {
        $image = Image::find($imageId);

        if ($image && $image->article_id == $this->article->id) {
            Storage::disk('public')->delete($image->path);
            $image->delete();

            $this->article = $this->article->fresh();
            $this->images = $this->article->images->toArray();

            session()->flash('imageDeleted', 'Immagine eliminata con successo.');
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        $this->article->refresh();

        $this->article->title = $this->title;
        $this->article->description = $this->description;
        $this->article->price = $this->price;
        $this->article->category_id = $this->category;
        $this->article->is_accepted = null; // 🔁 Torna in revisione
        $this->article->save();

        if (count($this->newImages) > 0) {
            foreach ($this->newImages as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);

                dispatch(new ResizeImage($newImage->path, 300, 500));
                dispatch(new ResizeImage($newImage->path, 600, 600));
                dispatch(new ResizeImage($newImage->path, 500, 500));
                dispatch(new ResizeImage($newImage->path, 150, 150));

                dispatch(new GoogleVisionSafeSearch($newImage->id));
                dispatch(new GoogleVisionLabelImage($newImage->id));
            }
        }

        $this->dispatch('EditeArticle');

        $this->temporary_images = [];
        $this->newImages = [];

        session()->flash('success', 'Modifica salvata! L’articolo sarà riesaminato.');
    }
}
