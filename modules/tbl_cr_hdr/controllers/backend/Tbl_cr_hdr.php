<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Cr Hdr Controller
*| --------------------------------------------------------------------------
*| Tbl Cr Hdr site
*|
*/
class Tbl_cr_hdr extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_cr_hdr');
		$this->load->model('group/model_group');
		$this->lang->load('web_lang', $this->current_lang);
	}

	/**
	* show all Tbl Cr Hdrs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_cr_hdr_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_cr_hdrs'] = $this->model_tbl_cr_hdr->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_cr_hdr_counts'] = $this->model_tbl_cr_hdr->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tbl_cr_hdr/index/',
			'total_rows'   => $this->data['tbl_cr_hdr_counts'],
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('CR Input Header List');
		$this->render('backend/standart/administrator/tbl_cr_hdr/tbl_cr_hdr_list', $this->data);
	}
	
	/**
	* Add new tbl_cr_hdrs
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_cr_hdr_add');

		$this->template->title('CR Input Header New');
		$this->render('backend/standart/administrator/tbl_cr_hdr/tbl_cr_hdr_add', $this->data);
	}

	/**
	* Add New Tbl Cr Hdrs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_cr_hdr_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		

		$this->form_validation->set_rules('cr_no_hdr', 'Cr No Hdr', 'trim|required|max_length[3]');
		

		$this->form_validation->set_rules('cr_foto', 'Cr Foto', 'trim|required|max_length[300]');
		

		$this->form_validation->set_rules('cr_tanggal', 'Cr Tanggal', 'trim|required');
		

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'cr_no_hdr' => $this->input->post('cr_no_hdr'),
				'cr_foto' => $this->input->post('cr_foto'),
				'cr_tanggal' => $this->input->post('cr_tanggal'),
				'cr_created_at' => date('Y-m-d H:i:s'),
				'cr_updated_at' => date('Y-m-d H:i:s'),
			];

			
			
			$save_tbl_cr_hdr = $this->model_tbl_cr_hdr->store($save_data);
            

			if ($save_tbl_cr_hdr) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_cr_hdr;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tbl_cr_hdr/edit/' . $save_tbl_cr_hdr, 'Edit Tbl Cr Hdr'),
						anchor('administrator/tbl_cr_hdr', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tbl_cr_hdr/edit/' . $save_tbl_cr_hdr, 'Edit Tbl Cr Hdr')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_cr_hdr');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_cr_hdr');
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
	* Update view Tbl Cr Hdrs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_cr_hdr_update');

		$this->data['tbl_cr_hdr'] = $this->model_tbl_cr_hdr->find($id);

		$this->template->title('CR Input Header Update');
		$this->render('backend/standart/administrator/tbl_cr_hdr/tbl_cr_hdr_update', $this->data);
	}

	/**
	* Update Tbl Cr Hdrs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_cr_hdr_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
				$this->form_validation->set_rules('cr_no_hdr', 'Cr No Hdr', 'trim|required|max_length[3]');
		

		$this->form_validation->set_rules('cr_foto', 'Cr Foto', 'trim|required|max_length[300]');
		

		$this->form_validation->set_rules('cr_tanggal', 'Cr Tanggal', 'trim|required');
		

		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'cr_no_hdr' => $this->input->post('cr_no_hdr'),
				'cr_foto' => $this->input->post('cr_foto'),
				'cr_tanggal' => $this->input->post('cr_tanggal'),
				'cr_created_at' => date('Y-m-d H:i:s'),
				'cr_updated_at' => date('Y-m-d H:i:s'),
			];


			
			
			$save_tbl_cr_hdr = $this->model_tbl_cr_hdr->change($id, $save_data);

			if ($save_tbl_cr_hdr) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tbl_cr_hdr', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tbl_cr_hdr');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tbl_cr_hdr');
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
	* delete Tbl Cr Hdrs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_cr_hdr_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_cr_hdr'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_cr_hdr'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Cr Hdrs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_cr_hdr_view');

		$this->data['tbl_cr_hdr'] = $this->model_tbl_cr_hdr->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('CR Input Header Detail');
		$this->render('backend/standart/administrator/tbl_cr_hdr/tbl_cr_hdr_view', $this->data);
	}
	
	/**
	* delete Tbl Cr Hdrs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_cr_hdr = $this->model_tbl_cr_hdr->find($id);

		
		
		return $this->model_tbl_cr_hdr->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_cr_hdr_export');

		$this->model_tbl_cr_hdr->export(
			'tbl_cr_hdr', 
			'tbl_cr_hdr',
			$this->model_tbl_cr_hdr->field_search
		);
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_cr_hdr_export');

		$this->model_tbl_cr_hdr->pdf('tbl_cr_hdr', 'tbl_cr_hdr');
	}


	public function single_pdf($id = null)
	{
		$this->is_allowed('tbl_cr_hdr_export');

		$table = $title = 'tbl_cr_hdr';
		$this->load->library('HtmlPdf');
      
        $config = array(
            'orientation' => 'p',
            'format' => 'a4',
            'marges' => array(5, 5, 5, 5)
        );

        $this->pdf = new HtmlPdf($config);
        $this->pdf->setDefaultFont('stsongstdlight'); 

        $result = $this->db->get($table);
       
        $data = $this->model_tbl_cr_hdr->find($id);
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


/* End of file tbl_cr_hdr.php */
/* Location: ./application/controllers/administrator/Tbl Cr Hdr.php */