<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Form Kode Cost Cr Controller
*| --------------------------------------------------------------------------
*| Form Form Kode Cost Cr site
*|
*/
class Form_form_kode_cost_cr extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_form_kode_cost_cr');
	}

	/**
	* Submit Form Form Kode Cost Crs
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('kode_cost_product', 'Kode Cost Product', 'trim|required');
		$this->form_validation->set_rules('kode_cost_induk', 'Kode Cost Induk', 'trim|required');
		$this->form_validation->set_rules('kode_cost_cabang', 'Kode Cost Cabang', 'trim|required');
		$this->form_validation->set_rules('kode_cost_ranting', 'Kode Cost Ranting', 'trim|required');
		$this->form_validation->set_rules('kode_cost_uraian', 'Kode Cost Uraian', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_cost_product' => $this->input->post('kode_cost_product'),
				'kode_cost_induk' => $this->input->post('kode_cost_induk'),
				'kode_cost_cabang' => $this->input->post('kode_cost_cabang'),
				'kode_cost_ranting' => $this->input->post('kode_cost_ranting'),
				'kode_cost_uraian' => $this->input->post('kode_cost_uraian'),
			];

			
			$save_form_form_kode_cost_cr = $this->model_form_form_kode_cost_cr->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_form_kode_cost_cr;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_form_kode_cost_cr.php */
/* Location: ./application/controllers/administrator/Form Form Kode Cost Cr.php */