<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo css_url('uploadify') ?>" media="screen" />

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('uploadify/jquery.uploadify.min') ?>" media="screen" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = '<?php echo base_url(); ?>';

        $('#upload-file').click(function (e) {
            e.preventDefault();
            $('#userfile').uploadify('upload', '*');
        });

        $('#userfile').uploadify({
            'auto':true,
            'swf': base_url + 'assets/javascript/uploadify/uploadify.swf',
            'uploader': base_url + 'index.php/mc_musique/do_upload',
            'cancelImg': base_url + 'assets/images/common/uploadify-cancel.png',
            'fileTypeExts':'*.jpg;*.jpeg;*.png;*.gif;*.mp3;',
            'fileTypeDesc':'Image Files (.jpg,.jpeg,.png,.gif,.mp3)',
            'fileSizeLimit':'100000MB',
            'fileObjName':'userfile',
            'buttonText':'Select Photo(s)',
            'multi':true,
            'removeCompleted':false,
            'debug':false,
            'buttonImage': null
        });
    });
</script>   

<div class="pop-in_cent">
    <span>Ajouter des musiques</span>
    
    <div class="content-pi-cent">
        <?php $user = $this->uri->segment(3); ?>

        <div class="elem_center">
            <?php echo json_encode($file_info); ?>
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('pop_in_general/do_upload_musique'); ?>
            <ul class="unstyled">
                <li>
                    <?php echo form_upload('userfile', '', 'id="userfile"'); ?>
                    <?php echo (isset($error)) ? $error : ''; ?>
                </li>
                <li>
                    <?php echo form_button(array('content' => 'Upload', 'id' => 'upload-file', 'class' => 'btn btn-large btn-primary')); ?>
                </li>
            </ul>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>