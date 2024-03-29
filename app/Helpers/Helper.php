<?php

namespace App\Helpers;

class Helper {
    public static function menu($menus, $parent_id = 0, $char = '') {
        $html = '';
        foreach ($menus as $key => $menu) {
            if  ($menu->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <th scope="row"> ' .  $menu->id . '</th>
                    <td>'.$char  .$menu->name . '</td>
                    <td>'.  self::active($menu->active) . '</td>
                    <td>'.  $menu->updated_at . '</td>
                    <td>
                        <a class = "btn btn-warning btn-sm" href = "/admin/menus/edit/ '. $menu->id .' "> <i class="fa-solid fa-pen-to-square"></i> </a>
                        <a class = "btn btn-danger btn-sm" href ="#" onclick = "removeRow('. $menu->id . ', \'/admin/menus/destroy\')"> <i class="fa-solid fa-trash"></i> </a>
                    </td>
                </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char .'|--');

            }
        }
        return $html;
    }

    public static function active($active = 0) :string {
        return $active == 0? '<span class = "btn btn-danger btn-xs">NO</span>' : '<span class = "btn btn-success btn-xs">YES</span>';
    }
}
