<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class Product extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    

    protected $fillable = ['name','slug','short_description','description' , 'regular_price', 'sale_price', 'SKU','stock_status','featured','quantity','image','images','category_id'];
    protected $table="products";

    protected $casts = [
        'images' => 'array'
    ];


    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "assets/images/products";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function setPhotosAttribute($value)
    {
        $attribute_name = "images";
        $disk = "public";
        $destination_path = "assets/images/products";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
        
    }

}
