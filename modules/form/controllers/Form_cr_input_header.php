<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Cr Input Header Controller
*| --------------------------------------------------------------------------
*| Form Cr Input Header site
*|
*/
class Form_cr_input_header extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_cr_input_header');
	}

	/**
	* Submit Form Cr Input Headers
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('form_cr_input_header_silahkan_upload_foto_cr__name', 'Silahkan Upload Foto CR ', 'trim|required');
		$this->form_validation->set_rules('silahkan_pilih_tanggal_cr', 'Silahkan Pilih Tanggal CR', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_project', 'Pilih Kode Cost Project', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_induk', 'Pilih Kode Cost Induk', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_cabang', 'Pilih Kode Cost Cabang', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_ranting', 'Pilih Kode Cost Ranting', 'trim|required');
		$this->form_validation->set_rules('silahkan_isi_uraian_cr', 'Silahkan Isi Uraian CR', 'trim|required');
		
		if ($this->form_validation->run()) {
			$form_cr_input_header_silahkan_upload_foto_cr__uuid = $this->input->post('form_cr_input_header_silahkan_upload_foto_cr__uuid');
			$form_cr_input_header_silahkan_upload_foto_cr__name = $this->input->post('form_cr_input_header_silahkan_upload_foto_cr__name');
		
			$save_data = [
				'silahkan_upload_foto_cr_' => $this->input->post('silahkan_upload_foto_cr_'),
				'silahkan_pilih_tanggal_cr' => $this->input->post('silahkan_pilih_tanggal_cr'),
				'pilih_kode_cost_project' => $this->input->post('pilih_kode_cost_project'),
				'pilih_kode_cost_induk' => $this->input->post('pilih_kode_cost_induk'),
				'pilih_kode_cost_cabang' => $this->input->post('pilih_kode_cost_cabang'),
				'pilih_kode_cost_ranting' => $this->input->post('pilih_kode_cost_ranting'),
				'silahkan_isi_uraian_cr' => $this->input->post('silahkan_isi_uraian_cr'),
			];

			if (!is_dir(FCPATH . '/uploads/form_cr_input_header/')) {
				mkdir(FCPATH . '/uploads/form_cr_input_header/');
			}

			if (!empty($form_cr_input_header_silahkan_upload_foto_cr__uuid)) {
				$form_cr_input_header_silahkan_upload_foto_cr__name_copy = date('YmdHis') . '-' . $form_cr_input_header_silahkan_upload_foto_cr__name;

				rename(FCPATH . 'uploads/tmp/' . $form_cr_input_header_silahkan_upload_foto_cr__uuid . '/' . $form_cr_input_header_silahkan_upload_foto_cr__name, 
						FCPATH . 'uploads/form_cr_input_header/' . $form_cr_input_header_silahkan_upload_foto_cr__name_copy);

				if (!is_file(FCPATH . '/uploads/form_cr_input_header/' . $form_cr_input_header_silahkan_upload_foto_cr__name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['silahkan_upload_foto_cr_'] = $form_cr_input_header_silahkan_upload_foto_cr__name_copy;
			}
		
			
			$save_form_cr_input_header = $this->model_form_cr_input_header->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_cr_input_header;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
	/**
	* Upload Image Form Cr Input Header	* 
	* @return JSON
	*/
	public function upload_silahkan_upload_foto_cr__file()
	{
		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'form_cr_input_header',
		]);
	}

	/**
	* Delete Image Form Cr Input Header	* 
	* @return JSON
	*/
	public function delete_silahkan_upload_foto_cr__file($uuid)
	{
		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'silahkan_upload_foto_cr_', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'form_cr_input_header',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_cr_input_header/'
        ]);
	}

	/**
	* Get Image Form Cr Input Header	* 
	* @return JSON
	*/
	public function get_silahkan_upload_foto_cr__file($id)
	{
		$form_cr_input_header = $this->model_form_cr_input_header->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'silahkan_upload_foto_cr_', 
            'table_name'        => 'form_cr_input_header',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_cr_input_header/',
            'delete_endpoint'   => 'administrator/form_cr_input_header/delete_silahkan_upload_foto_cr__file'
        ]);
	}
	
}


/* End of file form_cr_input_header.php */
/* Location: ./application/controllers/administrator/Form Cr Input Header.php */