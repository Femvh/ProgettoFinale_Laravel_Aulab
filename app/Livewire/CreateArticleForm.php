<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\RemoveFaces;

class CreateArticleForm extends Component
{
    use WithFileUploads;
    
    #[Validate('required|min:5')]
    public $title;
    
    #[Validate('required|min:10')]
    public $description;
    
    #[Validate('required|numeric')]
    public $price;
    
    #[Validate('required')]
    public $category;
    
    public $images = [];              // Immagini pronte
    public $temporary_images = [];    // Livewire temp
    public $article;
    
    public function save()
    {
        $this->validate();
        
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id(),
        ]);
        
        foreach ($this->images as $image) {
            $newPath = "articles/{$this->article->id}";
            $newImage = $this->article->images()->create([
                'path' => $image->store($newPath, 'public'),
            ]);
            
            
            
            
            RemoveFaces::withChain([
                new ResizeImage($newImage->path, 300, 500),
                new ResizeImage($newImage->path, 600, 600),
                new ResizeImage($newImage->path, 500, 500),
                new ResizeImage($newImage->path, 150, 150),
                
                
                new GoogleVisionSafeSearch($newImage->id),
                new GoogleVisionLabelImage($newImage->id)
                
            ])->dispatch($newImage->id);
            
            
        }
        
        $tmpPath = storage_path('app/livewire-tmp');
        if (File::exists($tmpPath)) {
            File::deleteDirectories($tmpPath);
        }
        
        $this->resetForm();
        
        session()->flash('success', 'Articolo creato correttamente!');
        $this->dispatch('articleCreated');
    }
    
    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:2048',
            'temporary_images' => 'max:6',
        ]);
        
        foreach ($this->temporary_images as $image) {
            if (count($this->images) < 6) {
                $this->images[] = $image;
            }
        }
    }
    
    #[On('removeImageFromForm')]
    public function removeImage($key)
    {
        if (array_key_exists($key, $this->images)) {
            unset($this->images[$key]);
        }
    }
    
    protected function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->images = [];
        $this->temporary_images = [];
    }
    
    public function render()
    {
        return view('livewire.create-article-form', [
            'categories' => Category::all(),
        ]);
    }
}