
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/manage-form/Form_form_kode_cost_cr/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Form Kode Cost CR<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Form Kode Cost CR</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                        <?php is_allowed('form_form_kode_cost_cr_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export', 'Form Form Kode Cost Cr'); ?>" href="<?= site_url('administrator/manage-form/form_form_kode_cost_cr/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?></a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Form Kode Cost CR</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', 'Form Kode Cost CR'); ?>  <i class="label bg-yellow"><?= $form_form_kode_cost_cr_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_form_form_kode_cost_cr" id="form_form_form_kode_cost_cr" action="<?= base_url('administrator/manage-form/form_form_kode_cost_cr/index'); ?>">
                  
                  <div class="table-responsive">
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Kode Cost Product</th>
                           <th>Kode Cost Induk</th>
                           <th>Kode Cost Cabang</th>
                           <th>Kode Cost Ranting</th>
                           <th>Kode Cost Uraian</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_form_form_kode_cost_cr">
                     <?php foreach($form_form_kode_cost_crs as $form_form_kode_cost_cr): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $form_form_kode_cost_cr->id; ?>">
                           </td>
                           <td><?= _ent($form_form_kode_cost_cr->kode_cost_product); ?></td> 
                           <td><?= _ent($form_form_kode_cost_cr->kode_cost_induk); ?></td> 
                           <td><?= _ent($form_form_kode_cost_cr->kode_cost_cabang); ?></td> 
                           <td><?= _ent($form_form_kode_cost_cr->kode_cost_ranting); ?></td> 
                           <td><?= _ent($form_form_kode_cost_cr->kode_cost_uraian); ?></td> 
                           <td width="200">
                              <?php is_allowed('form_form_kode_cost_cr_view', function() use ($form_form_kode_cost_cr){?>
                              <a href="<?= site_url('administrator/manage-form/form_form_kode_cost_cr/view/' . $form_form_kode_cost_cr->id); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('form_form_kode_cost_cr_update', function() use ($form_form_kode_cost_cr){?>
                              <a href="<?= site_url('administrator/manage-form/form_form_kode_cost_cr/edit/' . $form_form_kode_cost_cr->id); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('form_form_kode_cost_cr_delete', function() use ($form_form_kode_cost_cr){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/manage-form/form_form_kode_cost_cr/delete/' . $form_form_kode_cost_cr->id); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($form_form_kode_cost_cr_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                            <?= cclang('data_is_not_avaiable', 'Form Form Kode Cost CR'); ?>
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete"><?= cclang('delete'); ?></option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="apply bulk actions"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'kode_cost_product' ? 'selected' :''; ?> value="kode_cost_product">Kode Cost Product</option>
                           <option <?= $this->input->get('f') == 'kode_cost_induk' ? 'selected' :''; ?> value="kode_cost_induk">Kode Cost Induk</option>
                           <option <?= $this->input->get('f') == 'kode_cost_cabang' ? 'selected' :''; ?> value="kode_cost_cabang">Kode Cost Cabang</option>
                           <option <?= $this->input->get('f') == 'kode_cost_ranting' ? 'selected' :''; ?> value="kode_cost_ranting">Kode Cost Ranting</option>
                           <option <?= $this->input->get('f') == 'kode_cost_uraian' ? 'selected' :''; ?> value="kode_cost_uraian">Kode Cost Uraian</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/manage-form/form_form_kode_cost_cr');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>
</section>
<!-- /.content -->

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_form_form_kode_cost_cr').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/manage-form/form_form_kode_cost_cr/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>