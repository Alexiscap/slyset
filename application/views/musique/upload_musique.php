<link type="text/css" rel="stylesheet" href="<?php echo css_url('uploadify') ?>" />
        
<script type="text/javascript" src="<?php echo js_url('uploadify/jquery.uploadify.min'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = '<?php echo base_url(); ?>';
        var current_album = '<?php echo $current_album; ?>';

        $('#upload-file').click(function (e) {
            e.preventDefault();
            $('#userfile').uploadify('upload', '*');
        });
        
        var testinput = $('#testinput').val();

        $('#userfile').uploadify({
//            'formData' : {'testinput' : testinput},
//            'formData': { 'userid': $("#uid").val(), 'guid': $("#guid").val() },
            'checkExisting' : base_url + 'index.php/mc_musique/check_exists',
            'auto':false,
            'swf': base_url + 'assets/javascript/uploadify/uploadify.swf',
            'uploader': base_url + 'index.php/mc_musique/do_upload_musique/' + current_album,
            'cancelImg': base_url + 'assets/images/common/uploadify-cancel.png',
//            'fileTypeExts':'*.jpg;*.jpeg;*.png;*.gif;*.mp3;',
//            'fileTypeDesc':'Image Files (.jpg,.jpeg,.png,.gif,.mp3)',
            'fileTypeExts':'*.mp3;',
            'fileTypeDesc':'Image Files (,.mp3)',
            'fileSizeLimit':'1000000MB',
            'fileObjName':'userfile',
            'buttonText':'Select',
            'multi':true,
            'removeCompleted':false,
            'debug':false,
            'buttonImage': null,
            'onSelect' : function(file) {
                console.log(file);
//                alert('The file ' + file.name + ' was added to the queue.');
            },
            'onUploadStart' : function(file) {
                $('#userfile').uploadify('settings','formData',{
                    'price': $('#'+file.id).find('input.price').val()
                });
                console.log(file.id);
            },
            'onUploadComplete' : function (file) {
//                $('#userfile').uploadify('cancel',''+file.id+'');
            },
            'onError' : function (a, b, c, d) {
                if (d.status == 404)
                    alert('Could not find upload script.');
                else if (d.type === "HTTP")
                    alert('error '+d.type+": "+d.status);
                else if (d.type ==="File Size")
                    alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
                else
                    alert('error '+d.type+": "+d.text);
            },
            'onDialogClose' : function() {
                $('.uploadify-queue-item').append('<input type="text" placeholder="Votre prix" name="price" class="price" />');
//                alert(this.queueData.filesQueued);
            }
        });
    });
</script>


<div class="pop-in_cent pop-in-upload-music">
    <span>Ajouter des musiques</span>
    
    <div class="content-pi-cent">
        <?php $user = $this->uri->segment(3); ?>

        <div class="elem_center">
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('mc_musique/do_upload_musique/'.$current_album); ?>
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
        
        <!--<p><a href="javascript:jQuery('#userfile').uploadifyClearQueue()">Cancel All Uploads</a></p>-->
    </div>
</div>