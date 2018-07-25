<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Map_table extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Map_table_model');
    } 

    /*
     * Listing of map_table
     */
    function index()
    {
        $data['map_table'] = $this->Map_table_model->get_all_map_table();
        
        $data['_view'] = 'map_table/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new map_table
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'MAP_IMG' => $this->input->post('MAP_IMG'),
				'MAP_STATUS' => $this->input->post('MAP_STATUS'),
				'MAP_NAME' => $this->input->post('MAP_NAME'),
            );
            
            $map_table_id = $this->Map_table_model->add_map_table($params);
            redirect('map_table/index');
        }
        else
        {            
            $data['_view'] = 'map_table/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a map_table
     */
    function edit($MAP_RID)
    {   
        // check if the map_table exists before trying to edit it
        $data['map_table'] = $this->Map_table_model->get_map_table($MAP_RID);
        
        if(isset($data['map_table']['MAP_RID']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'MAP_IMG' => $this->input->post('MAP_IMG'),
					'MAP_STATUS' => $this->input->post('MAP_STATUS'),
					'MAP_NAME' => $this->input->post('MAP_NAME'),
                );

                $this->Map_table_model->update_map_table($MAP_RID,$params);            
                redirect('map_table/index');
            }
            else
            {
                $data['_view'] = 'map_table/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The map_table you are trying to edit does not exist.');
    } 

    /*
     * Deleting map_table
     */
    function remove($MAP_RID)
    {
        $map_table = $this->Map_table_model->get_map_table($MAP_RID);

        // check if the map_table exists before trying to delete it
        if(isset($map_table['MAP_RID']))
        {
            $this->Map_table_model->delete_map_table($MAP_RID);
            redirect('map_table/index');
        }
        else
            show_error('The map_table you are trying to delete does not exist.');
    }
    
}
