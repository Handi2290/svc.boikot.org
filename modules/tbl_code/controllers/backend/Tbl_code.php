<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Code Controller
*| --------------------------------------------------------------------------
*| Tbl Code site
*|
*/
class Tbl_code extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_code');
		$this->load->model('group/model_group');
		$this->lang->load('web_lang', $this->current_lang);
	}

	/**
	* show all Tbl Codes
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_code_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_codes'] = $this->model_tbl_code->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_code_counts'] = $this->model_tbl_code->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tbl_code/index/',
			'total_rows'   => $this->data['tbl_code_counts'],
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kode Cost CR List');
		$this->render('backend/standart/administrator/tbl_code/tbl_code_list', $this->data);
	}
	
	/**
	* Add new tbl_codes
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_code_add');

		$this->template->title('Kode Cost CR New');
		$this->render('backend/standart/administrator/tbl_code/tbl_code_add', $this->data);
	}

	/**
	* Add New Tbl Codes
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_code_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		

		$this->form_validation->set_rules('project', 'Project', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('induk', 'Induk', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required|max_length[2]');
		

		$this->form_validation->set_rules('ranting', 'Ranting', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required|max_length[300]');
		

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'project' => $this->input->post('project'),
				'induk' => $this->input->post('induk'),
				'cabang' => $this->input->post('cabang'),
				'ranting' => $this->input->post('ranting'),
				'uraian' => $this->input->post('uraian'),
			];

			
			
			$save_tbl_code = $this->model_tbl_code->store($save_data);
            

			if ($save_tbl_code) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_code;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tbl_code/edit/' . $save_tbl_code, 'Edit Tbl Code'),
						anchor('administrator/tbl_code', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tbl_code/edit/' . $save_tbl_code, 'Edit Tbl Code')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_code');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_code');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = 'Opss validation failed';
			$this->data['errors'] = $this->form_validation->error_array();
		}

		$this->response($this->data);
	}
	
		/**
	* Update view Tbl Codes
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_code_update');

		$this->data['tbl_code'] = $this->model_tbl_code->find($id);

		$this->template->title('Kode Cost CR Update');
		$this->render('backend/standart/administrator/tbl_code/tbl_code_update', $this->data);
	}

	/**
	* Update Tbl Codes
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_code_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
				$this->form_validation->set_rules('project', 'Project', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('induk', 'Induk', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required|max_length[2]');
		

		$this->form_validation->set_rules('ranting', 'Ranting', 'trim|required|max_length[1]');
		

		$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required|max_length[300]');
		

		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'project' => $this->input->post('project'),
				'induk' => $this->input->post('induk'),
				'cabang' => $this->input->post('cabang'),
				'ranting' => $this->input->post('ranting'),
				'uraian' => $this->input->post('uraian'),
			];


			
			
			$save_tbl_code = $this->model_tbl_code->change($id, $save_data);

			if ($save_tbl_code) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tbl_code', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_code');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_code');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = 'Opss validation failed';
			$this->data['errors'] = $this->form_validation->error_array();
		}

		$this->response($this->data);
	}
	
	/**
	* delete Tbl Codes
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_code_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_code'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_code'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Codes
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_code_view');

		$this->data['tbl_code'] = $this->model_tbl_code->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Kode Cost CR Detail');
		$this->render('backend/standart/administrator/tbl_code/tbl_code_view', $this->data);
	}
	
	/**
	* delete Tbl Codes
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_code = $this->model_tbl_code->find($id);

		
		
		return $this->model_tbl_code->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_code_export');

		$this->model_tbl_code->export(
			'tbl_code', 
			'tbl_code',
			$this->model_tbl_code->field_search
		);
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_code_export');

		$this->model_tbl_code->pdf('tbl_code', 'tbl_code');
	}


	public function single_pdf($id = null)
	{
		$this->is_allowed('tbl_code_export');

		$table = $title = 'tbl_code';
		$this->load->library('HtmlPdf');
      
        $config = array(
            'orientation' => 'p',
            'format' => 'a4',
            'marges' => array(5, 5, 5, 5)
        );

        $this->pdf = new HtmlPdf($config);
        $this->pdf->setDefaultFont('stsongstdlight'); 

        $result = $this->db->get($table);
       
        $data = $this->model_tbl_code->find($id);
        $fields = $result->list_fields();

        $content = $this->pdf->loadHtmlPdf('core_template/pdf/pdf_single', [
            'data' => $data,
            'fields' => $fields,
            'title' => $title
        ], TRUE);

        $this->pdf->initialize($config);
        $this->pdf->pdf->SetDisplayMode('fullpage');
        $this->pdf->writeHTML($content);
        $this->pdf->Output($table.'.pdf', 'H');
	}

	
}


/* End of file tbl_code.php */
/* Location: ./application/controllers/administrator/Tbl Code.php */