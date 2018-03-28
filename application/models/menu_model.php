<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public $table_name = 'tbl_menu';

	public function __construct()
    {
        parent::__construct();
        // $this->getCurrentMenus();
    }

	public function getCurrentMenus(){
		$this->db->where('menu_status', 'active');
		$this->db->where('menu_order !=', '-1');
		$this->db->order_by('menu_order', 'ASC');
		$query = $this->db->get($this->table_name);
		$menus = $query->result_array();

		if(!empty($menus)){
            return $menus;
            
        } else {
        }
	}

	public function getSeeHowToBuy() {
		$this->db->where('menu_status', 'active');
		$this->db->where('menu_order', -1);
		$query = $this->db->get($this->table_name);
		$seehowtobuy = $query->result_array();
		return $seehowtobuy[0];
		// if(!empty($menus)){
  //           return $seehowtobuy;
            
  //       } else {
  //       }
	}
}