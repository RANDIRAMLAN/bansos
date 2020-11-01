<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

    public function getMenu($roleId)
    {
        return $this->db->table('user_menu')
            ->JOIN('user_akses_menu', 'user_menu.id=user_akses_menu.menuId')
            ->WHERE(['user_akses_menu.roleId' => $roleId])
            ->get()->getResultArray();
    }

    public function getSubMenu($roleId)
    {
        return $this->db->table('user_sub_menu')
            ->JOIN('user_menu', 'user_sub_menu.menuId=user_menu.id')
            ->WHERE(['user_sub_menu.isActive' => 1])
            ->WHERE([
                'user_menu.id' =>
                $this->db->table('user_menu')
                    ->select('user_menu.id')
                    ->join('user_akses_menu', 'user_menu.id=user_akses_menu.menuId')
                    ->where(['user_akses_menu.roleId' => $roleId])
                    ->get()->getRowArray()
            ])
            ->get()->getResultArray();
    }

    public function userMenu($segment)
    {
        return $this->db->table('user_menu')->select('id')->where(['menu' => $segment])->get()->getResultArray();
    }

    public function getAkses($menuId, $roleId)
    {
        return $this->db->table('user_akses_menu')->where(['roleId' => $roleId])->where(['menuId' => $menuId])->get()->getFirstRow();
    }
}
