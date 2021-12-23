<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Form_cr_input_header extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_form_cr_input_header');
	}

	/**
	 * @api {get} /form_cr_input_header/all Get all form_cr_input_headers.
	 * @apiVersion 0.1.0
	 * @apiName AllFormcrinputheader 
	 * @apiGroup form_cr_input_header
	 * @apiHeader {String} X-Api-Key Form cr input headers unique access-key.
	 * @apiHeader {String} X-Token Form cr input headers unique token.
	 * @apiPermission Form cr input header Cant be Accessed permission name : api_form_cr_input_header_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Form cr input headers.
	 * @apiParam {String} [Field="All Field"] Optional field of Form cr input headers : id, silahkan_upload_foto_cr_, silahkan_pilih_tanggal_cr, pilih_kode_cost_project, pilih_kode_cost_induk, pilih_kode_cost_cabang, pilih_kode_cost_ranting, silahkan_isi_uraian_cr.
	 * @apiParam {String} [Start=0] Optional start index of Form cr input headers.
	 * @apiParam {String} [Limit=10] Optional limit data of Form cr input headers.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of form_cr_input_header.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataForm cr input header Form cr input header data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_form_cr_input_header_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id', 'silahkan_upload_foto_cr_', 'silahkan_pilih_tanggal_cr', 'pilih_kode_cost_project', 'pilih_kode_cost_induk', 'pilih_kode_cost_cabang', 'pilih_kode_cost_ranting', 'silahkan_isi_uraian_cr'];
		$form_cr_input_headers = $this->model_api_form_cr_input_header->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_form_cr_input_header->count_all($filter, $field);
		$form_cr_input_headers = array_map(function($row){
			$row->pilih_kode_cost_project = $this->db
			    ->get_where('tbl_code', [
			    	'project' => $row->pilih_kode_cost_project])
			    ->row();
	        $row->pilih_kode_cost_induk = $this->db
			    ->get_where('tbl_code', [
			    	'induk' => $row->pilih_kode_cost_induk])
			    ->row();
	        $row->pilih_kode_cost_cabang = $this->db
			    ->get_where('tbl_code', [
			    	'cabang' => $row->pilih_kode_cost_cabang])
			    ->row();
	        $row->pilih_kode_cost_ranting = $this->db
			    ->get_where('tbl_code', [
			    	'ranting' => $row->pilih_kode_cost_ranting])
			    ->row();
	        			
			return $row;
		}, $form_cr_input_headers);

		$form_cr_input_header_arr = [];

		foreach ($form_cr_input_headers as $form_cr_input_header) {
			$form_cr_input_header->silahkan_upload_foto_cr_  = BASE_URL.'uploads/form_cr_input_header/'.$form_cr_input_header->silahkan_upload_foto_cr_;
			$form_cr_input_header_arr[] = $form_cr_input_header;
		}

		$data['form_cr_input_header'] = $form_cr_input_header_arr;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Form cr input header',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /form_cr_input_header/detail Detail Form cr input header.
	 * @apiVersion 0.1.0
	 * @apiName DetailForm cr input header
	 * @apiGroup form_cr_input_header
	 * @apiHeader {String} X-Api-Key Form cr input headers unique access-key.
	 * @apiHeader {String} X-Token Form cr input headers unique token.
	 * @apiPermission Form cr input header Cant be Accessed permission name : api_form_cr_input_header_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Form cr input headers.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of form_cr_input_header.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Form cr input headerNotFound Form cr input header data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_form_cr_input_header_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$select_field = ['id', 'silahkan_upload_foto_cr_', 'silahkan_pilih_tanggal_cr', 'pilih_kode_cost_project', 'pilih_kode_cost_induk', 'pilih_kode_cost_cabang', 'pilih_kode_cost_ranting', 'silahkan_isi_uraian_cr'];
		$form_cr_input_header = $this->model_api_form_cr_input_header->find($id, $select_field);

		if (!$form_cr_input_header) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

		$form_cr_input_header->pilih_kode_cost_project = $this->db
		    ->get_where('tbl_code', [
		    	'project' => $form_cr_input_header->pilih_kode_cost_project])
		    ->row();
        $form_cr_input_header->pilih_kode_cost_induk = $this->db
		    ->get_where('tbl_code', [
		    	'induk' => $form_cr_input_header->pilih_kode_cost_induk])
		    ->row();
        $form_cr_input_header->pilih_kode_cost_cabang = $this->db
		    ->get_where('tbl_code', [
		    	'cabang' => $form_cr_input_header->pilih_kode_cost_cabang])
		    ->row();
        $form_cr_input_header->pilih_kode_cost_ranting = $this->db
		    ->get_where('tbl_code', [
		    	'ranting' => $form_cr_input_header->pilih_kode_cost_ranting])
		    ->row();
        			
		$data['form_cr_input_header'] = $form_cr_input_header;
		if ($data['form_cr_input_header']) {
			$data['form_cr_input_header']->silahkan_upload_foto_cr_ = BASE_URL.'uploads/form_cr_input_header/'.$data['form_cr_input_header']->silahkan_upload_foto_cr_;
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Form cr input header',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form cr input header not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /form_cr_input_header/add Add Form cr input header.
	 * @apiVersion 0.1.0
	 * @apiName AddForm cr input header
	 * @apiGroup form_cr_input_header
	 * @apiHeader {String} X-Api-Key Form cr input headers unique access-key.
	 * @apiHeader {String} X-Token Form cr input headers unique token.
	 * @apiPermission Form cr input header Cant be Accessed permission name : api_form_cr_input_header_add
	 *
 	 * @apiParam {File} Silahkan_upload_foto_cr_ Mandatory silahkan_upload_foto_cr_ of Form cr input headers.  
	 * @apiParam {String} Silahkan_pilih_tanggal_cr Mandatory silahkan_pilih_tanggal_cr of Form cr input headers.  
	 * @apiParam {String} Pilih_kode_cost_project Mandatory pilih_kode_cost_project of Form cr input headers. Input Pilih Kode Cost Project Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_induk Mandatory pilih_kode_cost_induk of Form cr input headers. Input Pilih Kode Cost Induk Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_cabang Mandatory pilih_kode_cost_cabang of Form cr input headers. Input Pilih Kode Cost Cabang Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_ranting Mandatory pilih_kode_cost_ranting of Form cr input headers. Input Pilih Kode Cost Ranting Max Length : 225. 
	 * @apiParam {String} Silahkan_isi_uraian_cr Mandatory silahkan_isi_uraian_cr of Form cr input headers.  
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_form_cr_input_header_add');

		$this->form_validation->set_rules('silahkan_pilih_tanggal_cr', 'Silahkan Pilih Tanggal Cr', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_project', 'Pilih Kode Cost Project', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_induk', 'Pilih Kode Cost Induk', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_cabang', 'Pilih Kode Cost Cabang', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_ranting', 'Pilih Kode Cost Ranting', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('silahkan_isi_uraian_cr', 'Silahkan Isi Uraian Cr', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'silahkan_pilih_tanggal_cr' => $this->input->post('silahkan_pilih_tanggal_cr'),
				'pilih_kode_cost_project' => $this->input->post('pilih_kode_cost_project'),
				'pilih_kode_cost_induk' => $this->input->post('pilih_kode_cost_induk'),
				'pilih_kode_cost_cabang' => $this->input->post('pilih_kode_cost_cabang'),
				'pilih_kode_cost_ranting' => $this->input->post('pilih_kode_cost_ranting'),
				'silahkan_isi_uraian_cr' => $this->input->post('silahkan_isi_uraian_cr'),
			];
			if (!is_dir(FCPATH . '/uploads/form_cr_input_header')) {
				mkdir(FCPATH . '/uploads/form_cr_input_header');
			}
			
			$config = [
				'upload_path' 	=> './uploads/form_cr_input_header/',
					'required' 		=> true
			];
			
			if ($upload = $this->upload_file('silahkan_upload_foto_cr_', $config)){
				$upload_data = $this->upload->data();
				$save_data['silahkan_upload_foto_cr_'] = $upload['file_name'];
			}

			$save_form_cr_input_header = $this->model_api_form_cr_input_header->store($save_data);

			if ($save_form_cr_input_header) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Validation Errors.',
				'errors' 	=> $this->form_validation->error_array()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /form_cr_input_header/update Update Form cr input header.
	 * @apiVersion 0.1.0
	 * @apiName UpdateForm cr input header
	 * @apiGroup form_cr_input_header
	 * @apiHeader {String} X-Api-Key Form cr input headers unique access-key.
	 * @apiHeader {String} X-Token Form cr input headers unique token.
	 * @apiPermission Form cr input header Cant be Accessed permission name : api_form_cr_input_header_update
	 *
	 * @apiParam {File} Silahkan_upload_foto_cr_ Mandatory silahkan_upload_foto_cr_ of Form cr input headers.  
	 * @apiParam {String} Silahkan_pilih_tanggal_cr Mandatory silahkan_pilih_tanggal_cr of Form cr input headers.  
	 * @apiParam {String} Pilih_kode_cost_project Mandatory pilih_kode_cost_project of Form cr input headers. Input Pilih Kode Cost Project Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_induk Mandatory pilih_kode_cost_induk of Form cr input headers. Input Pilih Kode Cost Induk Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_cabang Mandatory pilih_kode_cost_cabang of Form cr input headers. Input Pilih Kode Cost Cabang Max Length : 225. 
	 * @apiParam {String} Pilih_kode_cost_ranting Mandatory pilih_kode_cost_ranting of Form cr input headers. Input Pilih Kode Cost Ranting Max Length : 225. 
	 * @apiParam {String} Silahkan_isi_uraian_cr Mandatory silahkan_isi_uraian_cr of Form cr input headers.  
	 * @apiParam {Integer} id Mandatory id of Form Cr Input Header.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_form_cr_input_header_update');

		
		$this->form_validation->set_rules('silahkan_pilih_tanggal_cr', 'Silahkan Pilih Tanggal Cr', 'trim|required');
		$this->form_validation->set_rules('pilih_kode_cost_project', 'Pilih Kode Cost Project', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_induk', 'Pilih Kode Cost Induk', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_cabang', 'Pilih Kode Cost Cabang', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('pilih_kode_cost_ranting', 'Pilih Kode Cost Ranting', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('silahkan_isi_uraian_cr', 'Silahkan Isi Uraian Cr', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'silahkan_pilih_tanggal_cr' => $this->input->post('silahkan_pilih_tanggal_cr'),
				'pilih_kode_cost_project' => $this->input->post('pilih_kode_cost_project'),
				'pilih_kode_cost_induk' => $this->input->post('pilih_kode_cost_induk'),
				'pilih_kode_cost_cabang' => $this->input->post('pilih_kode_cost_cabang'),
				'pilih_kode_cost_ranting' => $this->input->post('pilih_kode_cost_ranting'),
				'silahkan_isi_uraian_cr' => $this->input->post('silahkan_isi_uraian_cr'),
			];
			if (!is_dir(FCPATH . '/uploads/form_cr_input_header')) {
				mkdir(FCPATH . '/uploads/form_cr_input_header');
			}
			
			$config = [
				'upload_path' 	=> './uploads/form_cr_input_header/',
					'required' 		=> true
			];
			
			if ($upload = $this->upload_file('silahkan_upload_foto_cr_', $config)){
				$upload_data = $this->upload->data();
				$save_data['silahkan_upload_foto_cr_'] = $upload['file_name'];
			}

			$save_form_cr_input_header = $this->model_api_form_cr_input_header->change($this->post('id'), $save_data);

			if ($save_form_cr_input_header) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Validation Errors.',
				'errors' 	=> $this->form_validation->error_array()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /form_cr_input_header/delete Delete Form cr input header. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteForm cr input header
	 * @apiGroup form_cr_input_header
	 * @apiHeader {String} X-Api-Key Form cr input headers unique access-key.
	 * @apiHeader {String} X-Token Form cr input headers unique token.
	 	 * @apiPermission Form cr input header Cant be Accessed permission name : api_form_cr_input_header_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Form cr input headers .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_form_cr_input_header_delete');

		$form_cr_input_header = $this->model_api_form_cr_input_header->find($this->post('id'));

		if (!$form_cr_input_header) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form cr input header not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_form_cr_input_header->remove($this->post('id'));

			if (!empty($form_cr_input_header->silahkan_upload_foto_cr_)) {
				$path = FCPATH . '/uploads/form_cr_input_header/' . $form_cr_input_header->silahkan_upload_foto_cr_;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}

		}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Form cr input header deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form cr input header not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Form cr input header.php */
/* Location: ./application/controllers/api/Form cr input header.php */