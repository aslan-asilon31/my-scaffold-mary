<?php

namespace App\Helpers\Permission\Traits;

use App\Models\PositionPermission;
use App\Models\EmployeeAccount;

trait WithPermission
{

    use FixWithPermission; 

    public function permission($permissionId = '')
    {
        $permissionId  = $this->index($permissionId); 
        

        $employeeAccount =  EmployeeAccount::with('employee')->where('employee_id', auth()->user()->employee_id)->first();
        
        if ($employeeAccount && $employeeAccount->employee) {
            $positionId =  $employeeAccount->employee->position_id;
        }
        
        $positionPermissionId = $positionId . "-" . $permissionId;


        $positionPermissionCount = PositionPermission::where('id', $positionPermissionId)->count();

        if ($positionPermissionCount <= 0) {
            return redirect()->route('unauthorized');
            // abort(403, 'Unauthorized action.'); 
        }

        return true; 
    }

}
