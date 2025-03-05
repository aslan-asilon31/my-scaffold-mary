<?php

namespace App\Livewire\Pages\Visitor\CartCheckoutResources;

use Livewire\Component;
use App\Models\Customer;
use App\Models\SalesShipping;
use App\Models\SalesOrder;
use App\Models\SalesInvoice;
use App\Models\SalesPayment;
use App\Models\SalesOrderDetail;
use App\Livewire\Pages\Visitor\CartCheckoutResources\Forms\CartCheckoutForm;
use App\Models\SalesCart;
use App\Models\SalesCartDetail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Services\ProductService;
use App\Services\CartService;

class CartCheckoutCrud extends Component
{

    public $title = 'Cart Checkout Form';  
    public $first_name;  
    public $last_name;  
    public $email;  
    public $phone;  
    public $address;  
    public $postal_code;  
    public $isSubmitted = false;  
    public $formattedDate;
    public $randomNumber;
  

    use \Mary\Traits\Toast;

    public CartCheckoutForm $masterForm;

    public $products;
    protected $productService;
    public $cartItems = [];  
    protected $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function submit()  
    {  
        $sessionId = Session::getId();

        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {

            $customer = Customer::create([  
                'first_name' => $validatedForm['first_name'],  
                'last_name' => $validatedForm['last_name'],  
                'email' => $validatedForm['email'],  
                'phone' => $validatedForm['phone'],  
                'created_by' => $validatedForm['first_name'].' '.$validatedForm['last_name'],   
                'updated_by' => $validatedForm['first_name'].' '.$validatedForm['last_name'],   
                'is_activated' => 1, 
            ]);  
            \Illuminate\Support\Facades\DB::commit(); 


            $this->formattedDate = Carbon::now()->format('d/F/Y');

            $this->randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $salesOrder = SalesOrder::create([  
                'employee_id' => auth()->user()->id ?? '',  
                'customer_id' => $customer->id,
                'date' => now(),
                'number' => 'so-'.$this->formattedDate.'-'.$this->randomNumber,
                'total_amount' => $this->cartService->calculateFinalTotal(), 
                'status' => 'pending', 
                'fraud_status' => 'identifying', 
                'created_by' => $validatedForm['first_name'] ." ". $validatedForm['last_name'] , 
                'is_activated' => 1, 
            ]);  
            \Illuminate\Support\Facades\DB::commit(); 
            dd($salesOrder);


            SalesShipping::create([  
                'sales_order_id' => $salesOrder->id,  
                'address' => $validatedForm['address'],  
                'postal_code' => $validatedForm['postal_code'], 
                'created_by' => $validatedForm['first_name'] ." ". $validatedForm['last_name'] , 
                'is_activated' => 1, 
            ]);  
            \Illuminate\Support\Facades\DB::commit(); 



            $salesInvoice = SalesInvoice::create([  
                'sales_order_id' => $salesOrder->id,  
                'date' => now(),  
                'number' => 'so-'.$this->formattedDate.'-'.$this->randomNumber,  
                'created_by' => $validatedForm['first_name'] ." ". $validatedForm['last_name'] , 
                'is_activated' => 1, 
            ]);  
            \Illuminate\Support\Facades\DB::commit(); 
            
            SalesPayment::create([  
                'sales_invoice_id' => $salesInvoice->id,  
                'date' => now(),  
                'number' => 'so-'.$this->formattedDate.'-'.$this->randomNumber,  
                'created_by' => $validatedForm['first_name'] ." ". $validatedForm['last_name'] , 
                'is_activated' => 1, 
            ]);  
            \Illuminate\Support\Facades\DB::commit(); 


            $salesCarts = SalesCart::with('details')->where('session_id', $sessionId)->get();  
  
            // Menggunakan flatMap untuk mengumpulkan semua product_id dan selling_price  
            $products = $salesCarts->flatMap(function ($cart) {  
                return $cart->details->map(function ($detail) {  
                    return [  
                        'product_id' => $detail->product_id,  
                        'selling_price' => $detail->selling_price,  
                        'discount_persentage' => $detail->discount_persentage,  
                        'discount_value' => $detail->discount_value,  
                        'nett_price' => $detail->nett_price,  
                        'qty' => $detail->qty,  
                        'amount' => $detail->amount,  
                    ];  
                });  
            });  
            \Illuminate\Support\Facades\DB::commit(); 
            
            // Mengonversi koleksi menjadi array untuk penyimpanan massal  
            $productsArray = $products->toArray();  
            
            // Menyimpan data ke dalam SalesOrderDetail  
            SalesOrderDetail::insert(array_map(function ($product) use ($salesOrder) {  
                return [  
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'sales_order_id' => $salesOrder->id,  
                    'product_id' => $product['product_id'],  
                    'selling_price' => $product['selling_price'],  
                    'discount_persentage' => $product['discount_persentage'],  
                    'discount_value' => $product['discount_value'],  
                    'nett_price' => $product['nett_price'],  
                    'qty' => $product['qty'],  
                    'amount' => $product['amount'],  
                    'created_at' => now(),  
                    'updated_at' => now(),  
                ];  
            }, $productsArray)); 
            \Illuminate\Support\Facades\DB::commit(); 


            // Mengumpulkan semua detail ID yang terkait dengan SalesCart  
            $detailIds = $salesCarts->flatMap(function ($cart) {  
                return $cart->details->pluck('id'); // Mengambil ID dari setiap detail  
            });  
        
            // Menghapus semua detail yang terkait dengan SalesCart dalam satu query  
            SalesCartDetail::whereIn('id', $detailIds)->delete();  
            \Illuminate\Support\Facades\DB::commit(); 

        
            // Menghapus SalesCart itu sendiri  
            SalesCart::where('session_id', $sessionId)->delete();  
            \Illuminate\Support\Facades\DB::commit(); 

            $this->isSubmitted = true;  
  
            // $this->reset();  
  
            session()->flash('message', 'Customer has been created successfully!');  
            $this->success('Data has been stored');

        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Log::error('Store data failed: ' . $th->getMessage());
            $this->error('Data failed to Store');
        }
  
        // Tandai bahwa formulir telah disubmit    
        $this->isSubmitted = true;    
    }  

    public function render()
    {
        return view('livewire.pages.visitor.cart-checkout-resources.cart-checkout-crud')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
 

   


}
