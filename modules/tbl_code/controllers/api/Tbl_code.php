<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Tbl_code extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_tbl_code');
	}

	/**
	 * @api {get} /tbl_code/all Get all tbl_codes.
	 * @apiVersion 0.1.0
	 * @apiName AllTblcode 
	 * @apiGroup tbl_code
	 * @apiHeader {String} X-Api-Key Tbl codes unique access-key.
	 * @apiHeader {String} X-Token Tbl codes unique token.
	 * @apiPermission Tbl code Cant be Accessed permission name : api_tbl_code_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Tbl codes.
	 * @apiParam {String} [Field="All Field"] Optional field of Tbl codes : id, project, induk, cabang, ranting, uraian.
	 * @apiParam {String} [Start=0] Optional start index of Tbl codes.
	 * @apiParam {String} [Limit=10] Optional limit data of Tbl codes.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of tbl_code.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataTbl code Tbl code data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_tbl_code_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id', 'project', 'induk', 'cabang', 'ranting', 'uraian'];
		$tbl_codes = $this->model_api_tbl_code->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_tbl_code->count_all($filter, $field);
		$tbl_codes = array_map(function($row){
						
			return $row;
		}, $tbl_codes);

		$data['tbl_code'] = $tbl_codes;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Tbl code',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /tbl_code/detail Detail Tbl code.
	 * @apiVersion 0.1.0
	 * @apiName DetailTbl code
	 * @apiGroup tbl_code
	 * @apiHeader {String} X-Api-Key Tbl codes unique access-key.
	 * @apiHeader {String} X-Token Tbl codes unique token.
	 * @apiPermission Tbl code Cant be Accessed permission name : api_tbl_code_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Tbl codes.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of tbl_code.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Tbl codeNotFound Tbl code data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_tbl_code_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$select_field = ['id', 'project', 'induk', 'cabang', 'ranting', 'uraian'];
		$tbl_code = $this->model_api_tbl_code->find($id, $select_field);

		if (!$tbl_code) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['tbl_code'] = $tbl_code;
		if ($data['tbl_code']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Tbl code',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Tbl code not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /tbl_code/add Add Tbl code.
	 * @apiVersion 0.1.0
	 * @apiName AddTbl code
	 * @apiGroup tbl_code
	 * @apiHeader {String} X-Api-Key Tbl codes unique access-key.
	 * @apiHeader {String} X-Token Tbl codes unique token.
	 * @apiPermission Tbl code Cant be Accessed permission name : api_tbl_code_add
	 *
 	 * @apiParam {String} Project Mandatory project of Tbl codes. Input Project Max Length : 1. 
	 * @apiParam {String} Induk Mandatory induk of Tbl codes. Input Induk Max Length : 1. 
	 * @apiParam {String} Cabang Mandatory cabang of Tbl codes. Input Cabang Max Length : 2. 
	 * @apiParam {String} Ranting Mandatory ranting of Tbl codes. Input Ranting Max Length : 1. 
	 * @apiParam {String} Uraian Mandatory uraian of Tbl codes. Input Uraian Max Length : 300. 
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
		$this->is_allowed('api_tbl_code_add');

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
			
			$save_tbl_code = $this->model_api_tbl_code->store($save_data);

			if ($save_tbl_code) {
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
	 * @api {post} /tbl_code/update Update Tbl code.
	 * @apiVersion 0.1.0
	 * @apiName UpdateTbl code
	 * @apiGroup tbl_code
	 * @apiHeader {String} X-Api-Key Tbl codes unique access-key.
	 * @apiHeader {String} X-Token Tbl codes unique token.
	 * @apiPermission Tbl code Cant be Accessed permission name : api_tbl_code_update
	 *
	 * @apiParam {String} Project Mandatory project of Tbl codes. Input Project Max Length : 1. 
	 * @apiParam {String} Induk Mandatory induk of Tbl codes. Input Induk Max Length : 1. 
	 * @apiParam {String} Cabang Mandatory cabang of Tbl codes. Input Cabang Max Length : 2. 
	 * @apiParam {String} Ranting Mandatory ranting of Tbl codes. Input Ranting Max Length : 1. 
	 * @apiParam {String} Uraian Mandatory uraian of Tbl codes. Input Uraian Max Length : 300. 
	 * @apiParam {Integer} id Mandatory id of Tbl Code.
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
		$this->is_allowed('api_tbl_code_update');

		
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
			
			$save_tbl_code = $this->model_api_tbl_code->change($this->post('id'), $save_data);

			if ($save_tbl_code) {
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
	 * @api {post} /tbl_code/delete Delete Tbl code. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteTbl code
	 * @apiGroup tbl_code
	 * @apiHeader {String} X-Api-Key Tbl codes unique access-key.
	 * @apiHeader {String} X-Token Tbl codes unique token.
	 	 * @apiPermission Tbl code Cant be Accessed permission name : api_tbl_code_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Tbl codes .
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
		$this->is_allowed('api_tbl_code_delete');

		$tbl_code = $this->model_api_tbl_code->find($this->post('id'));

		if (!$tbl_code) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Tbl code not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_tbl_code->remove($this->post('id'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Tbl code deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Tbl code not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Tbl code.php */
/* Location: ./application/controllers/api/Tbl code.php */