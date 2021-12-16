
<script src="<?= BASE_ASSET; ?>js/custom.js"></script>

<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>

<?php $this->load->view('core_template/fine_upload'); ?>

<?= form_open('', [
    'name'    => 'form_form_cr_input_header', 
    'class'   => 'form-horizontal form_form_cr_input_header', 
    'id'      => 'form_form_cr_input_header',
    'enctype' => 'multipart/form-data', 
    'method'  => 'POST'
]); ?>
 
<div class="form-group ">
    <label for="silahkan_upload_foto_cr_" class="col-sm-2 control-label">Silahkan Upload Foto CR  
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <div id="form_cr_input_header_silahkan_upload_foto_cr__galery" ></div>
        <input class="data_file" name="form_cr_input_header_silahkan_upload_foto_cr__uuid" id="form_cr_input_header_silahkan_upload_foto_cr__uuid" type="hidden" >
        <input class="data_file" name="form_cr_input_header_silahkan_upload_foto_cr__name" id="form_cr_input_header_silahkan_upload_foto_cr__name" type="hidden" >
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="silahkan_pilih_tanggal_cr" class="col-sm-2 control-label">Silahkan Pilih Tanggal CR 
    <i class="required">*</i>
    </label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datepicker" name="silahkan_pilih_tanggal_cr"  placeholder="" id="silahkan_pilih_tanggal_cr" >
    </div>
    <small class="info help-block">
    </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="pilih_kode_cost_project" class="col-sm-2 control-label">Pilih Kode Cost Project 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="pilih_kode_cost_project" id="pilih_kode_cost_project" data-placeholder="Select Pilih Kode Cost Project"  >
            <option value=""></option>
            <?php foreach (db_get_all_data('tbl_code') as $row): ?>
            <option value="<?= $row->project ?>"><?= $row->project; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>

 
<div class="form-group ">
    <label for="pilih_kode_cost_induk" class="col-sm-2 control-label">Pilih Kode Cost Induk 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="pilih_kode_cost_induk" id="pilih_kode_cost_induk" data-placeholder="Select Pilih Kode Cost Induk"  >
            <option value=""></option>
            <?php foreach (db_get_all_data('tbl_code') as $row): ?>
            <option value="<?= $row->induk ?>"><?= $row->induk; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>

 
<div class="form-group ">
    <label for="pilih_kode_cost_cabang" class="col-sm-2 control-label">Pilih Kode Cost Cabang 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="pilih_kode_cost_cabang" id="pilih_kode_cost_cabang" data-placeholder="Select Pilih Kode Cost Cabang"  >
            <option value=""></option>
            <?php foreach (db_get_all_data('tbl_code') as $row): ?>
            <option value="<?= $row->cabang ?>"><?= $row->cabang; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>

 
<div class="form-group ">
    <label for="pilih_kode_cost_ranting" class="col-sm-2 control-label">Pilih Kode Cost Ranting 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="pilih_kode_cost_ranting" id="pilih_kode_cost_ranting" data-placeholder="Select Pilih Kode Cost Ranting"  >
            <option value=""></option>
            <?php foreach (db_get_all_data('tbl_code') as $row): ?>
            <option value="<?= $row->ranting ?>"><?= $row->ranting; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>

 
<div class="form-group ">
    <label for="silahkan_isi_uraian_cr" class="col-sm-2 control-label">Silahkan Isi Uraian CR 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <textarea id="silahkan_isi_uraian_cr" name="silahkan_isi_uraian_cr" rows="5" class="textarea form-control" ></textarea>
        <small class="info help-block">
        </small>
    </div>
</div>


<div class="row col-sm-12 message">
</div>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='stay'>
    Submit
    </button>
    <span class="loading loading-hide">
    <img src="http://localhost:8080/asset//img/loading-spin-primary.svg"> 
    <i>Loading, Submitting data</i>
    </span>
</div>
</form></div>


<!-- Page script -->
<script>
    $(document).ready(function(){
          $('.form-preview').submit(function(){
        return false;
     });

     $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
     });


    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_form_cr_input_header = $('#form_form_cr_input_header');
        var data_post = form_form_cr_input_header.serializeArray();
        var save_type = $(this).attr('data-stype');
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'form/form_cr_input_header/submit',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_silahkan_upload_foto_cr_ = $('#form_cr_input_header_silahkan_upload_foto_cr__galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_silahkan_upload_foto_cr_ !== 'undefined') {
                    $('#form_cr_input_header_silahkan_upload_foto_cr__galery').fineUploader('deleteFile', id_silahkan_upload_foto_cr_);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 1000);
        });
    
        return false;
      }); /*end btn save*/


      
             
       var params = {};
       params[csrf] = token;

       $('#form_cr_input_header_silahkan_upload_foto_cr__galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + 'form/form_cr_input_header/upload_silahkan_upload_foto_cr__file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + 'form/form_cr_input_header/delete_silahkan_upload_foto_cr__file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#form_cr_input_header_silahkan_upload_foto_cr__galery').fineUploader('getUuid', id);
                   $('#form_cr_input_header_silahkan_upload_foto_cr__uuid').val(uuid);
                   $('#form_cr_input_header_silahkan_upload_foto_cr__name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#form_cr_input_header_silahkan_upload_foto_cr__uuid').val();
                  $.get(BASE_URL + 'form/form_cr_input_header/delete_silahkan_upload_foto_cr__file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#form_cr_input_header_silahkan_upload_foto_cr__uuid').val('');
                  $('#form_cr_input_header_silahkan_upload_foto_cr__name').val('');
                }
              }
          }
      }); /*end silahkan_upload_foto_cr_ galey*/
           
    }); /*end doc ready*/
</script>