<?php

namespace App\Livewire\Article;

use App\Models\Article;
use App\Models\Category;
use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $categories = [];
    public $providers = [];

    public function save()
    {

        $this->validate([
            'name' => ['required','string','max:200'],
            'description' => ['nullable','string','max:200'],
            'categories' => ['nullable'],
            'providers' => ['required'],
            'price' => ['required','decimal:2','min:0'],
            'stock' => ['nullable','integer','min:0','max:100'],
            'image' => ['nullable','image','max:4096']
        ],[
            'price.required' => 'El precio del articulo es obligatorio.',
            'price.decimal' => 'El precio debe ser un numero de 2 decimales.',
            'stock.integer' => 'El numero de articulos disponibles debe ser un numero entero.',
            'stock.min' => 'El numero de articulos disponibles no puede ser negativo.',
            'price.min' => 'El precio no puede ser negativo.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre sobrepasa el maximo de caracteres.',
            'description.max' => 'El campo nombre sobrepasa el maximo de caracteres.',
            'type.required' => 'Elija un tipo de persona.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
            'image.max' => 'La imagen debe ser de menos de 4mb.',
            'image.image' => 'El archivo debe ser una imagen.',
            'providers'=> 'Elija un proveedor.',
        ]);

        tap(Article::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
        ]),function($article){
            if($this->image){
                $article->addMedia($this->image->getRealPath())
                ->usingName($this->image->getClientOriginalName())
                ->toMediaCollection('article-image');
            }
            if($this->categories){
                $article->categories()->attach($this->categories);
            }
            if($this->providers){
                $article->providers()->attach($this->providers);
            }
        });

        session()->flash('flash.banner','Articulo creado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('articles.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.article.create',[
            'all_categories' => Category::all(),
            'all_providers' => Provider::all()
        ]);
    }
}
