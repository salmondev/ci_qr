<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Item_table_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get item_table by 
     */
    function get_item_table($item_uid)
    {
        return $this->db->get_where('ITEM_TABLE',array('item_uid'=>$item_uid))->row_array();
    }
        
    /*
     * Get all item_table
     */
    function get_all_item_table()
    {
        $this->db->order_by('item_uid', 'desc');
        return $this->db->get('ASSET')->result_array();
    }
        
    /*
     * function to add new item_table
     */
    function add_item_table($params)
    {
        $this->db->insert('ITEM_TABLE',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update item_table
     */
    function update_item_table($item_uid,$params)
    {
        $this->db->where('item_uid',$item_uid);
        return $this->db->update('ITEM_TABLE',$params);
    }
    
    /*
     * function to delete item_table
     */
    function delete_item_table($item_uid)
    {
        return $this->db->delete('ITEM_TABLE',array('item_uid'=>$item_uid));
    }
}
