<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;


class DetailsComponent extends Component
{
    public $slug;
    public $qty;   

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;               
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);                
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);        
    }

    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\\Models\\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    
    public function render()
    {
        $sale = Sale::find(1);
        $product = Product::where('slug',$this->slug)->first();              
        return view('livewire.details-component',['product'=>$product,'sale'=>$sale])->layout('layouts.base');
    }
}
     