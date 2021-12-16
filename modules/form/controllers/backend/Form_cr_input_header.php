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
	* show all Form Cr Input Headers
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_cr_input_header_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_cr_input_headers'] = $this->model_form_cr_input_header->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_cr_input_header_counts'] = $this->model_form_cr_input_header->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/manage-form/form_cr_input_header/index/',
			'total_rows'   => $this->model_form_cr_input_header->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('CR Input Header List');
		$this->render('backend/standart/administrator/form_builder/form_cr_input_header/form_cr_input_header_list', $this->data);
	}

	/**
	* Update view Form Cr Input Headers
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_cr_input_header_update');

		$this->data['form_cr_input_header'] = $this->model_form_cr_input_header->find($id);

		$this->template->title('CR Input Header Update');
		$this->render('backend/standart/administrator/form_builder/form_cr_input_header/form_cr_input_header_update', $this->data);
	}

	/**
	* Update Form Cr Input Headers
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_cr_input_header_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
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
		
			
			$save_form_cr_input_header = $this->model_form_cr_input_header->change($id, $save_data);

			if ($save_form_cr_input_header) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_cr_input_header', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_cr_input_header');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_cr_input_header');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Cr Input Headers
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_cr_input_header_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'Form Cr Input Header'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Cr Input Header'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Cr Input Headers
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_cr_input_header_view');

		$this->data['form_cr_input_header'] = $this->model_form_cr_input_header->find($id);

		$this->template->title('CR Input Header Detail');
		$this->render('backend/standart/administrator/form_builder/form_cr_input_header/form_cr_input_header_view', $this->data);
	}

	/**
	* delete Form Cr Input Headers
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_cr_input_header = $this->model_form_cr_input_header->find($id);

		if (!empty($form_cr_input_header->silahkan_upload_foto_cr_)) {
			$path = FCPATH . '/uploads/form_cr_input_header/' . $form_cr_input_header->silahkan_upload_foto_cr_;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		
		return $this->model_form_cr_input_header->remove($id);
	}
	
	/**
	* Upload Image Form Cr Input Header	* 
	* @return JSON
	*/
	public function upload_silahkan_upload_foto_cr__file()
	{
		if (!$this->is_allowed('form_cr_input_header_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

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
		if (!$this->is_allowed('form_cr_input_header_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

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
		if (!$this->is_allowed('form_cr_input_header_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

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
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_cr_input_header_export');

		$this->model_form_cr_input_header->export('form_cr_input_header', 'form_cr_input_header');
	}
}


/* End of file form_cr_input_header.php */
/* Location: ./application/controllers/administrator/Form Cr Input Header.php */