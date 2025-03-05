<?php  
  
namespace App\Http\Controllers\Api;  
  
use App\Http\Controllers\Controller;  
use App\Models\Action; // Pastikan untuk mengimpor model Action  
use Illuminate\Http\Request;  
  
class UserController extends Controller  
{  

    public function index()  
    {  
        $actions = Action::all();  
        return response()->json($actions);  
    }  
  

    public function store(Request $request)  
    {  
        $request->validate([  
            'name' => 'required|string|max:255',  
        ]);  
  
        $action = Action::create([  
            'name' => $request->name,  
        ]);  
  
        return response()->json($action, 201); 
    }  
  

    public function show(string $id)  
    {  
        $action = Action::findOrFail($id);  
        return response()->json($action);  
    }  
  
    /**  
     * Update the specified resource in storage.  
     */  
    public function update(Request $request, string $id)  
    {  
        // Validasi input  
        $request->validate([  
            'name' => 'required|string|max:255',  
        ]);  
  
        // Mencari aksi berdasarkan ID  
        $action = Action::findOrFail($id);  
        $action->update([  
            'name' => $request->name,  
        ]);  
  
        return response()->json($action);  
    }  
  
    /**  
     * Remove the specified resource from storage.  
     */  
    public function destroy(string $id)  
    {  
        // Mencari aksi berdasarkan ID dan menghapusnya  
        $action = Action::findOrFail($id);  
        $action->delete();  
  
        return response()->json(null, 204); // Mengembalikan response dengan status 204 No Content  
    }  
}  
