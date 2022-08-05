<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

use Cart;
// use Illuminate\Pagination\Paginator;
// Paginator::useBootstrap();

class ShopComponent extends Component
{
   use WithPagination;
   // protected $paginationTheme = 'bootstrap';


    public $pagesize;
    public $sorting;
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12; 
        $this->min_price=1;
        $this->max_price=20000;  
    }

    
    public function addToWishlist($product_id,$product_name,$product_price)
    {             
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product'); 
        $this->emitTo('wishlist-count-component','refreshComponent');
               
    } 


    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }


    
    
    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');              
        session()->flash('success_message','Item added in Cart');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->forget('coupon');
        return redirect()->route('product.cart');

    }   


        public function render()
        {  
            if($this->sorting=='date')   
            {
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);  
            }
            else if($this->sorting=="price")
            {
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize); 
            }
            else if($this->sorting=="price-desc")
            {
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize); 
            }
            else{
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);  
            }
            
            $categories= Category::all();
            $sale = Sale::find(1);

            $witems=Cart::instance('wishlist')->content()->pluck('id');
            
            if(Auth::check())
            {
                Cart::instance('cart')->store(Auth::user()->email);  
                Cart::instance('wishlist')->store(Auth::user()->email);       
            }

            return view('livewire.shop-component',['products'=> $products,'categories'=>$categories,'witems'=>$witems,'sale'=>$sale])->layout("layouts.base");
        }




}

