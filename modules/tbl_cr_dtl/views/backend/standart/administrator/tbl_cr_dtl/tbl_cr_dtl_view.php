
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      CR Input Detail      <small><?= cclang('detail', ['CR Input Detail']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/tbl_cr_dtl'); ?>">CR Input Detail</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">CR Input Detail</h3>
                     <h5 class="widget-user-desc">Detail CR Input Detail</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal form-step" name="form_tbl_cr_dtl" id="form_tbl_cr_dtl" >
                  
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Cr Id Dtl </label>

                        <div class="col-sm-8">
                           <?= _ent($tbl_cr_dtl->cr_id_dtl); ?>
                        </div>
                    </div>
                                        
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Cr Id Hdr </label>

                        <div class="col-sm-8">
                           <?= _ent($tbl_cr_dtl->cr_id_hdr); ?>
                        </div>
                    </div>
                                        
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Cr Tanggal </label>

                        <div class="col-sm-8">
                           <?= _ent($tbl_cr_dtl->cr_tanggal); ?>
                        </div>
                    </div>
                                        
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Cr Uraian </label>

                        <div class="col-sm-8">
                           <?= _ent($tbl_cr_dtl->cr_uraian); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>


                     
                         
                    <div class="view-nav">
                        <?php is_allowed('tbl_cr_dtl_update', function() use ($tbl_cr_dtl){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit tbl_cr_dtl (Ctrl+e)" href="<?= site_url('administrator/tbl_cr_dtl/edit/'.$tbl_cr_dtl->cr_id_dtl); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Tbl Cr Dtl']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/tbl_cr_dtl/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Tbl Cr Dtl']); ?></a>
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
<script>
$(document).ready(function(){

   });
</script>