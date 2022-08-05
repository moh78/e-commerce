<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Cart;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()


    {    
        $sproducts = Product::where('sale_price','>',0)->get();
        $sale = Sale::find(1);
        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);  
            Cart::instance('wishlist')->restore(Auth::user()->email);          
        } 
        return view('livewire.home-component',['sale'=>$sale,'sproducts'=>$sproducts])->layout("layouts.base");
    }
}


