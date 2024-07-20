<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Product $product;
    public $colors = [];
    public $sizes = [];
    protected $listeners = [
        'doneSave',
    ];
    
    public function doneSave($data)
    {

        foreach ($data as $key => $value) {
            if($value != null) {
                $this->product->{$key} = $value;
            }  
        }
        $this->validate();
        $product_data = $this->processData();
        DB::beginTransaction();
        try {
            
            $product = Product::create($product_data);


            if($this->product->colors != null && count($this->product->colors) > 0) {
                foreach ($this->product->colors as $color) {
                    ProductColor::create([
                        'product_id'    => $product->id,
                        'color_id'      => $color,
                    ]);
                }   
            }
            if($this->product->sizes != null && count($this->product->sizes) > 0) {
                foreach ($this->product->sizes as $size) {
                    ProductSize::create([
                        'product_id'    => $product->id,
                        'size_id'       => $size,
                    ]);
                }
            }
            
            
            $this->syncMedia($product);
            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return redirect()->back();

        }
        
       

    }
    
    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    protected function syncMedia($product): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $product->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.product.create');
    }

    public function submit()
    {

        $this->emit('getSelects');
/* 
       


        
        
         */
        
    }
    public function processData() : array {
        return [
            'ar' => [
                'name'                      => $this->product->name_ar,
                'meta_description'          => $this->product->meta_description_ar,
                'description'               => $this->product->description_ar,
                //'features'                  => json_encode($this->product->features_ar)
            ],
            'en' => [
                'name'                      => $this->product->name_en,
                'meta_description'          => $this->product->meta_description_en,
                'description'               => $this->product->description_en,
                //'features'                  => json_encode($this->product->features_en)
            ],
            'slug'                          => str_replace(' ', '-', $this->product->name_ar) . '-' . str_replace(' ', '-', $this->product->name_en).'-product',
            'category_id'                   => (int)$this->product->category_id,
            'country_id'                    => (int)$this->product->country_id,
            'price'                         => $this->product->price,
            'product_code'                  => ($this->product->product_code != null && $this->product->product_code != '' ? $this->product->product_code : $this->generateProductCode()),

         ];
    }
    
    protected function rules(): array
    {

        return [
        'product.category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
            'product.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'product.price' => [
                'numeric',
                'required',
            ],
            'product.colors' => [
               
                'nullable',
               // 'array'
            ],
            'product.sizes' => [
               
                'nullable',
                //'array'
            ],
            'product.product_code' => [
                'string',
                'max:255',
                'nullable',
                'unique:products,product_code',
            ],
            'product.name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'product.name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'product.meta_description_en' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'product.meta_description_ar' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'product.description_ar' => [
                'string',
                'required',
            ],
            'product.description_en' => [
                'string',
                'required',
            ],
            'mediaCollections.product_thumbnail' => [
                'array',
                'required',
            ],
            'mediaCollections.product_thumbnail.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'mediaCollections.product_images' => [
                'array',
                'required',
            ],
            'mediaCollections.product_images.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'mediaCollections.product_videos' => [
                'array',
                'nullable',
            ],
            'mediaCollections.product_videos.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'product.supplier_id' => [
                'integer',
                'exists:suppliers,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $categories =[];
        $countries =[];
        foreach (Category::get() as $category) {
            $categories[$category->id] = $category->translate(app()->getLocale())->name;
        }
        foreach (Country::get() as $country) {
            $countries[$country->id] = $country->translate(app()->getLocale())->name;
        }
        $this->listsForFields['category'] = $categories;
        $this->listsForFields['country']  = $countries;
        $this->listsForFields['color'] = Color::pluck('hex', 'id')->toArray();
        $this->listsForFields['size'] = Size::pluck('size', 'id')->toArray();
        $this->listsForFields['supplier'] = Supplier::pluck('name', 'id')->toArray();

    }

    public function generateProductCode()
    {
        return strtoupper(uniqid());
    }
}
