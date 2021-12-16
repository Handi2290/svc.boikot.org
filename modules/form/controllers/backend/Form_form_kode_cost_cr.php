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
	* show all Form Form Kode Cost Crs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_form_kode_cost_cr_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_form_kode_cost_crs'] = $this->model_form_form_kode_cost_cr->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_form_kode_cost_cr_counts'] = $this->model_form_form_kode_cost_cr->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/manage-form/form_form_kode_cost_cr/index/',
			'total_rows'   => $this->model_form_form_kode_cost_cr->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Form Kode Cost CR List');
		$this->render('backend/standart/administrator/form_builder/form_form_kode_cost_cr/form_form_kode_cost_cr_list', $this->data);
	}

	/**
	* Update view Form Form Kode Cost Crs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_form_kode_cost_cr_update');

		$this->data['form_form_kode_cost_cr'] = $this->model_form_form_kode_cost_cr->find($id);

		$this->template->title('Form Kode Cost CR Update');
		$this->render('backend/standart/administrator/form_builder/form_form_kode_cost_cr/form_form_kode_cost_cr_update', $this->data);
	}

	/**
	* Update Form Form Kode Cost Crs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_form_kode_cost_cr_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
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

			
			$save_form_form_kode_cost_cr = $this->model_form_form_kode_cost_cr->change($id, $save_data);

			if ($save_form_form_kode_cost_cr) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_form_kode_cost_cr', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_form_kode_cost_cr');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_form_kode_cost_cr');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Form Kode Cost Crs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_form_kode_cost_cr_delete');

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
            set_message(cclang('has_been_deleted', 'Form Form Kode Cost Cr'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Form Kode Cost Cr'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Form Kode Cost Crs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_form_kode_cost_cr_view');

		$this->data['form_form_kode_cost_cr'] = $this->model_form_form_kode_cost_cr->find($id);

		$this->template->title('Form Kode Cost CR Detail');
		$this->render('backend/standart/administrator/form_builder/form_form_kode_cost_cr/form_form_kode_cost_cr_view', $this->data);
	}

	/**
	* delete Form Form Kode Cost Crs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_form_kode_cost_cr = $this->model_form_form_kode_cost_cr->find($id);

		
		return $this->model_form_form_kode_cost_cr->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_form_kode_cost_cr_export');

		$this->model_form_form_kode_cost_cr->export('form_form_kode_cost_cr', 'form_form_kode_cost_cr');
	}
}


/* End of file form_form_kode_cost_cr.php */
/* Location: ./application/controllers/administrator/Form Form Kode Cost Cr.php */