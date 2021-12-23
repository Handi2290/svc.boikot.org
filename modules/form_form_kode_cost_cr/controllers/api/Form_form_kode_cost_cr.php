<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Form_form_kode_cost_cr extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_form_form_kode_cost_cr');
	}

	/**
	 * @api {get} /form_form_kode_cost_cr/all Get all form_form_kode_cost_crs.
	 * @apiVersion 0.1.0
	 * @apiName AllFormformkodecostcr 
	 * @apiGroup form_form_kode_cost_cr
	 * @apiHeader {String} X-Api-Key Form form kode cost crs unique access-key.
	 * @apiHeader {String} X-Token Form form kode cost crs unique token.
	 * @apiPermission Form form kode cost cr Cant be Accessed permission name : api_form_form_kode_cost_cr_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Form form kode cost crs.
	 * @apiParam {String} [Field="All Field"] Optional field of Form form kode cost crs : id, kode_cost_product, kode_cost_induk, kode_cost_cabang, kode_cost_ranting, kode_cost_uraian.
	 * @apiParam {String} [Start=0] Optional start index of Form form kode cost crs.
	 * @apiParam {String} [Limit=10] Optional limit data of Form form kode cost crs.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of form_form_kode_cost_cr.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataForm form kode cost cr Form form kode cost cr data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_form_form_kode_cost_cr_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id', 'kode_cost_product', 'kode_cost_induk', 'kode_cost_cabang', 'kode_cost_ranting', 'kode_cost_uraian'];
		$form_form_kode_cost_crs = $this->model_api_form_form_kode_cost_cr->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_form_form_kode_cost_cr->count_all($filter, $field);
		$form_form_kode_cost_crs = array_map(function($row){
						
			return $row;
		}, $form_form_kode_cost_crs);

		$data['form_form_kode_cost_cr'] = $form_form_kode_cost_crs;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Form form kode cost cr',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /form_form_kode_cost_cr/detail Detail Form form kode cost cr.
	 * @apiVersion 0.1.0
	 * @apiName DetailForm form kode cost cr
	 * @apiGroup form_form_kode_cost_cr
	 * @apiHeader {String} X-Api-Key Form form kode cost crs unique access-key.
	 * @apiHeader {String} X-Token Form form kode cost crs unique token.
	 * @apiPermission Form form kode cost cr Cant be Accessed permission name : api_form_form_kode_cost_cr_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Form form kode cost crs.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of form_form_kode_cost_cr.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Form form kode cost crNotFound Form form kode cost cr data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_form_form_kode_cost_cr_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$select_field = ['id', 'kode_cost_product', 'kode_cost_induk', 'kode_cost_cabang', 'kode_cost_ranting', 'kode_cost_uraian'];
		$form_form_kode_cost_cr = $this->model_api_form_form_kode_cost_cr->find($id, $select_field);

		if (!$form_form_kode_cost_cr) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['form_form_kode_cost_cr'] = $form_form_kode_cost_cr;
		if ($data['form_form_kode_cost_cr']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Form form kode cost cr',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form form kode cost cr not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /form_form_kode_cost_cr/add Add Form form kode cost cr.
	 * @apiVersion 0.1.0
	 * @apiName AddForm form kode cost cr
	 * @apiGroup form_form_kode_cost_cr
	 * @apiHeader {String} X-Api-Key Form form kode cost crs unique access-key.
	 * @apiHeader {String} X-Token Form form kode cost crs unique token.
	 * @apiPermission Form form kode cost cr Cant be Accessed permission name : api_form_form_kode_cost_cr_add
	 *
 	 * @apiParam {String} Kode_cost_product Mandatory kode_cost_product of Form form kode cost crs. Input Kode Cost Product Max Length : 225. 
	 * @apiParam {String} Kode_cost_induk Mandatory kode_cost_induk of Form form kode cost crs. Input Kode Cost Induk Max Length : 225. 
	 * @apiParam {String} Kode_cost_cabang Mandatory kode_cost_cabang of Form form kode cost crs. Input Kode Cost Cabang Max Length : 225. 
	 * @apiParam {String} Kode_cost_ranting Mandatory kode_cost_ranting of Form form kode cost crs. Input Kode Cost Ranting Max Length : 225. 
	 * @apiParam {String} Kode_cost_uraian Mandatory kode_cost_uraian of Form form kode cost crs.  
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
		$this->is_allowed('api_form_form_kode_cost_cr_add');

		$this->form_validation->set_rules('kode_cost_product', 'Kode Cost Product', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_induk', 'Kode Cost Induk', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_cabang', 'Kode Cost Cabang', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_ranting', 'Kode Cost Ranting', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_uraian', 'Kode Cost Uraian', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'kode_cost_product' => $this->input->post('kode_cost_product'),
				'kode_cost_induk' => $this->input->post('kode_cost_induk'),
				'kode_cost_cabang' => $this->input->post('kode_cost_cabang'),
				'kode_cost_ranting' => $this->input->post('kode_cost_ranting'),
				'kode_cost_uraian' => $this->input->post('kode_cost_uraian'),
			];
			
			$save_form_form_kode_cost_cr = $this->model_api_form_form_kode_cost_cr->store($save_data);

			if ($save_form_form_kode_cost_cr) {
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
	 * @api {post} /form_form_kode_cost_cr/update Update Form form kode cost cr.
	 * @apiVersion 0.1.0
	 * @apiName UpdateForm form kode cost cr
	 * @apiGroup form_form_kode_cost_cr
	 * @apiHeader {String} X-Api-Key Form form kode cost crs unique access-key.
	 * @apiHeader {String} X-Token Form form kode cost crs unique token.
	 * @apiPermission Form form kode cost cr Cant be Accessed permission name : api_form_form_kode_cost_cr_update
	 *
	 * @apiParam {String} Kode_cost_product Mandatory kode_cost_product of Form form kode cost crs. Input Kode Cost Product Max Length : 225. 
	 * @apiParam {String} Kode_cost_induk Mandatory kode_cost_induk of Form form kode cost crs. Input Kode Cost Induk Max Length : 225. 
	 * @apiParam {String} Kode_cost_cabang Mandatory kode_cost_cabang of Form form kode cost crs. Input Kode Cost Cabang Max Length : 225. 
	 * @apiParam {String} Kode_cost_ranting Mandatory kode_cost_ranting of Form form kode cost crs. Input Kode Cost Ranting Max Length : 225. 
	 * @apiParam {String} Kode_cost_uraian Mandatory kode_cost_uraian of Form form kode cost crs.  
	 * @apiParam {Integer} id Mandatory id of Form Form Kode Cost Cr.
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
		$this->is_allowed('api_form_form_kode_cost_cr_update');

		
		$this->form_validation->set_rules('kode_cost_product', 'Kode Cost Product', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_induk', 'Kode Cost Induk', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_cabang', 'Kode Cost Cabang', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_ranting', 'Kode Cost Ranting', 'trim|required|max_length[225]');
		$this->form_validation->set_rules('kode_cost_uraian', 'Kode Cost Uraian', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'kode_cost_product' => $this->input->post('kode_cost_product'),
				'kode_cost_induk' => $this->input->post('kode_cost_induk'),
				'kode_cost_cabang' => $this->input->post('kode_cost_cabang'),
				'kode_cost_ranting' => $this->input->post('kode_cost_ranting'),
				'kode_cost_uraian' => $this->input->post('kode_cost_uraian'),
			];
			
			$save_form_form_kode_cost_cr = $this->model_api_form_form_kode_cost_cr->change($this->post('id'), $save_data);

			if ($save_form_form_kode_cost_cr) {
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
	 * @api {post} /form_form_kode_cost_cr/delete Delete Form form kode cost cr. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteForm form kode cost cr
	 * @apiGroup form_form_kode_cost_cr
	 * @apiHeader {String} X-Api-Key Form form kode cost crs unique access-key.
	 * @apiHeader {String} X-Token Form form kode cost crs unique token.
	 	 * @apiPermission Form form kode cost cr Cant be Accessed permission name : api_form_form_kode_cost_cr_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Form form kode cost crs .
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
		$this->is_allowed('api_form_form_kode_cost_cr_delete');

		$form_form_kode_cost_cr = $this->model_api_form_form_kode_cost_cr->find($this->post('id'));

		if (!$form_form_kode_cost_cr) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form form kode cost cr not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_form_form_kode_cost_cr->remove($this->post('id'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Form form kode cost cr deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Form form kode cost cr not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Form form kode cost cr.php */
/* Location: ./application/controllers/api/Form form kode cost cr.php */