<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Cr Dtl Controller
*| --------------------------------------------------------------------------
*| Tbl Cr Dtl site
*|
*/
class Tbl_cr_dtl extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_cr_dtl');
		$this->load->model('group/model_group');
		$this->lang->load('web_lang', $this->current_lang);
	}

	/**
	* show all Tbl Cr Dtls
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_cr_dtl_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_cr_dtls'] = $this->model_tbl_cr_dtl->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_cr_dtl_counts'] = $this->model_tbl_cr_dtl->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tbl_cr_dtl/index/',
			'total_rows'   => $this->data['tbl_cr_dtl_counts'],
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('CR Input Detail List');
		$this->render('backend/standart/administrator/tbl_cr_dtl/tbl_cr_dtl_list', $this->data);
	}
	
	/**
	* Add new tbl_cr_dtls
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_cr_dtl_add');

		$this->template->title('CR Input Detail New');
		$this->render('backend/standart/administrator/tbl_cr_dtl/tbl_cr_dtl_add', $this->data);
	}

	/**
	* Add New Tbl Cr Dtls
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_cr_dtl_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		

		$this->form_validation->set_rules('cr_id_hdr', 'Cr Id Hdr', 'trim|required|max_length[2]');
		

		$this->form_validation->set_rules('cr_tanggal', 'Cr Tanggal', 'trim|required');
		

		$this->form_validation->set_rules('cr_uraian', 'Cr Uraian', 'trim|required|max_length[300]');
		

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'cr_id_hdr' => $this->input->post('cr_id_hdr'),
				'cr_tanggal' => $this->input->post('cr_tanggal'),
				'cr_uraian' => $this->input->post('cr_uraian'),
				'cr_user' => get_user_data('username'),
				'cr_created_at' => date('Y-m-d H:i:s'),
				'cr_updated_at' => date('Y-m-d H:i:s'),
				'cr_created_by' => get_user_data('username'),
				'cr_updated_by' => get_user_data('username'),
			];

			
			
			$save_tbl_cr_dtl = $this->model_tbl_cr_dtl->store($save_data);
            

			if ($save_tbl_cr_dtl) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_cr_dtl;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tbl_cr_dtl/edit/' . $save_tbl_cr_dtl, 'Edit Tbl Cr Dtl'),
						anchor('administrator/tbl_cr_dtl', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tbl_cr_dtl/edit/' . $save_tbl_cr_dtl, 'Edit Tbl Cr Dtl')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_cr_dtl');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_cr_dtl');
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
	* Update view Tbl Cr Dtls
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_cr_dtl_update');

		$this->data['tbl_cr_dtl'] = $this->model_tbl_cr_dtl->find($id);

		$this->template->title('CR Input Detail Update');
		$this->render('backend/standart/administrator/tbl_cr_dtl/tbl_cr_dtl_update', $this->data);
	}

	/**
	* Update Tbl Cr Dtls
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_cr_dtl_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
				$this->form_validation->set_rules('cr_id_hdr', 'Cr Id Hdr', 'trim|required|max_length[2]');
		

		$this->form_validation->set_rules('cr_tanggal', 'Cr Tanggal', 'trim|required');
		

		$this->form_validation->set_rules('cr_uraian', 'Cr Uraian', 'trim|required|max_length[300]');
		

		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'cr_id_hdr' => $this->input->post('cr_id_hdr'),
				'cr_tanggal' => $this->input->post('cr_tanggal'),
				'cr_uraian' => $this->input->post('cr_uraian'),
				'cr_user' => get_user_data('username'),
				'cr_created_at' => date('Y-m-d H:i:s'),
				'cr_updated_at' => date('Y-m-d H:i:s'),
				'cr_created_by' => get_user_data('username'),
				'cr_updated_by' => get_user_data('username'),
			];


			
			
			$save_tbl_cr_dtl = $this->model_tbl_cr_dtl->change($id, $save_data);

			if ($save_tbl_cr_dtl) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tbl_cr_dtl', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_cr_dtl');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_cr_dtl');
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
	* delete Tbl Cr Dtls
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_cr_dtl_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_cr_dtl'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_cr_dtl'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Cr Dtls
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_cr_dtl_view');

		$this->data['tbl_cr_dtl'] = $this->model_tbl_cr_dtl->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('CR Input Detail Detail');
		$this->render('backend/standart/administrator/tbl_cr_dtl/tbl_cr_dtl_view', $this->data);
	}
	
	/**
	* delete Tbl Cr Dtls
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_cr_dtl = $this->model_tbl_cr_dtl->find($id);

		
		
		return $this->model_tbl_cr_dtl->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_cr_dtl_export');

		$this->model_tbl_cr_dtl->export(
			'tbl_cr_dtl', 
			'tbl_cr_dtl',
			$this->model_tbl_cr_dtl->field_search
		);
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_cr_dtl_export');

		$this->model_tbl_cr_dtl->pdf('tbl_cr_dtl', 'tbl_cr_dtl');
	}


	public function single_pdf($id = null)
	{
		$this->is_allowed('tbl_cr_dtl_export');

		$table = $title = 'tbl_cr_dtl';
		$this->load->library('HtmlPdf');
      
        $config = array(
            'orientation' => 'p',
            'format' => 'a4',
            'marges' => array(5, 5, 5, 5)
        );

        $this->pdf = new HtmlPdf($config);
        $this->pdf->setDefaultFont('stsongstdlight'); 

        $result = $this->db->get($table);
       
        $data = $this->model_tbl_cr_dtl->find($id);
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


/* End of file tbl_cr_dtl.php */
/* Location: ./application/controllers/administrator/Tbl Cr Dtl.php */