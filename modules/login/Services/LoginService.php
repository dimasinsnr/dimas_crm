<?php

namespace Modules\Login\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * Menangani proses login dan mendapatkan menu berdasarkan hak akses.
     *
     * @param array $attributes
     * @return array
     */
    public function loginAndGetMenu(array $attributes)
    {
        if (Auth::attempt($attributes)) {
            session()->regenerate();
            $getPermission = auth()->user()->hak_akses_id;

            $menuRoles = DB::table('v_menu_role')
                ->where('menu_role_hak_akses_id', $getPermission)
                ->orderBy('menu_order', 'asc')
                ->get();

            if ($menuRoles->isEmpty()) {
                session()->flash('error', 'No menus available for your role');
            } else {
                $encodedMenuRoles = base64_encode(serialize($menuRoles));
                session(['menuRoles' => $encodedMenuRoles]);
            }

            return ['status' => 'success', 'message' => 'You are logged in.'];
        } else {
            return ['status' => 'error', 'message' => 'Email or password invalid.'];
        }
    }

    public function getDashboardCounts()
    {
        $productCount = DB::table('products')->count(); // Count of products
        $customerCount = DB::table('customers')->count(); // Count of customers
        $activeCustomerCount = DB::table('customers')
                                  ->where('customer_status', 1) // Count of active customers
                                  ->count();

        return [
            'productCount' => $productCount,
            'customerCount' => $customerCount,
            'activeCustomerCount' => $activeCustomerCount,
        ];
    }
}