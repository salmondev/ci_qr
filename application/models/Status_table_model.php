<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Status_table_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get status_table by STATUS_RID
     */
    function get_status_table($STATUS_RID)
    {
        return $this->db->get_where('status_table',array('STATUS_RID'=>$STATUS_RID))->row_array();
    }
        
    /*
     * Get all status_table
     */
    function get_all_status_table()
    {
        $this->db->order_by('STATUS_RID', 'desc');
        return $this->db->get('status_table')->result_array();
    }
        
    /*
     * function to add new status_table
     */
    function add_status_table($params)
    {
        $this->db->insert('status_table',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update status_table
     */
    function update_status_table($STATUS_RID,$params)
    {
        $this->db->where('STATUS_RID',$STATUS_RID);
        return $this->db->update('status_table',$params);
    }
    
    /*
     * function to delete status_table
     */
    function delete_status_table($STATUS_RID)
    {
        return $this->db->delete('status_table',array('STATUS_RID'=>$STATUS_RID));
    }
}