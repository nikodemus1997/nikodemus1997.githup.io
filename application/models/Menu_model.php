<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sup_menu`.*,`user_menu`.`menu`
                    FROM `user_sup_menu` JOIN `user_menu`
                      ON `user_sup_menu`.`menu_id` = `user_menu`.`id`   
        ";

        return $this->db->query($query)->result_array();
    }
}
