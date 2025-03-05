<?php  
  
namespace App\Http\Controllers\Api;  
  
use App\Http\Controllers\Controller;  
use App\Models\Company; // Pastikan untuk mengimpor model Action  
use Illuminate\Http\Request;  
  
class UserController extends Controller  
{  

    public function index()  
    {  
        $companies = Company::all();  
        return response()->json($companies);  
    }  
  
}  
