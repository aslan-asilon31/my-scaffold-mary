<?php

namespace App\Helpers\Permission\Traits;

use App\Models\PositionPermission;
use App\Models\EmployeeAccount;

trait FixWithPermission
{
    public function index($permissionId = '')
    {

        // Pisahkan kata-kata berdasarkan tanda hubung (-)
        $parts = explode('-', $permissionId);

        // Pastikan ada minimal 3 kata
        if (count($parts) < 3) {
            return $permissionId; // Jika tidak cukup kata, kembalikan asli
        }

        // Gabungkan dua kata pertama dengan tanda underscore (_)
        $firstTwoWords = $parts[0] . '_' . $parts[1];

        // Gabungkan dengan kata ketiga
        $permissionId = $firstTwoWords . '-' . $parts[2];



        return $permissionId;
    }

}
