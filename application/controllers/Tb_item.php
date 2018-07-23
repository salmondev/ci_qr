<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Tb_item extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tb_item_model');
    } 

    /*
     * Listing of tb_item
     */
    function index()
    {
        $data['tb_item'] = $this->Tb_item_model->get_all_tb_item();
        
        $data['_view'] = 'tb_item/index';
        $this->load->view('test',$data);
    }

    /*
     * Adding a new tb_item
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $odate=date("Y-m-d H:i:s");
            $params = array(
				'name' => $this->input->post('name'),
				'odate' => $odate,
				'detail' => $this->input->post('detail'),
            );
            
            $tb_item_id = $this->Tb_item_model->add_tb_item($params);
            redirect('tb_item/index');
        }
        else
        {            
            $data['_view'] = 'tb_item/add';
            $this->load->view('test',$data);
        }
    }  

    /*
     * Editing a tb_item
     */
    function edit($id)
    {   
        $odate=date("Y-m-d H:i:s");
        // check if the tb_item exists before trying to edit it
        $data['tb_item'] = $this->Tb_item_model->get_tb_item($id);
        
        
        if(isset($data['tb_item']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'name' => $this->input->post('name'),
					'odate' => $odate,
					'detail' => $this->input->post('detail'),
                );

                $this->Tb_item_model->update_tb_item($id,$params);            
                redirect('tb_item/index');
            }
            else
            {
                $data['_view'] = 'tb_item/edit';
                $this->load->view('test',$data);
            }
        }
        else
            show_error('The tb_item you are trying to edit does not exist.');
    } 

    /*
     * Deleting tb_item
     */
    function remove($id)
    {
        $tb_item = $this->Tb_item_model->get_tb_item($id);

        // check if the tb_item exists before trying to delete it
        if(isset($tb_item['id']))
        {
            $this->Tb_item_model->delete_tb_item($id);
            redirect('tb_item/index');
        }
        else
            show_error('The tb_item you are trying to delete does not exist.');
    }
    
}
