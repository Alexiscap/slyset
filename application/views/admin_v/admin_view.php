 <!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="http://localhost/slyset/assets/css/fileupload/bootstrap-image-gallery.min.css"/>
 		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/slyset/assets/css/fileupload/jquery.fileupload-ui.css"/>
 		
 		<script  src="http://code.jquery.com/jquery-1.7.min.js" ></script>
 		
 	    <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/tmpl.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/load-image.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/canvas-to-blob.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/bootstrap.min.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/bootstrap-image-gallery.min.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/jquery.iframe-transport.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/jquery.fileupload.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/jquery.fileupload-ip.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/jquery.fileupload-ui.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/locale.js" ></script>
        <script  type="text/javascript" src="http://localhost/slyset/assets/javascript/fileupload/main.js" ></script>
 
     </head>

    <body>
    
 
 <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">

            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Administration</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Admin</a></li>

            
              
            </ul>
            <p class="navbar-text pull-right">Logged in as <a href="#">Admin</a></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    </div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                
                    <li class="nav-header">Blog</li>
                    <li ><a href="#" title="new-article">New article</a></li>

                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
            <div class="hero-unit">
                <div id="content-admin">

                 

                    <div id="new-article">
                        <h1>New article</h1>

                        <div id="upload-img">
                            <h2>Upload (Format : JPG, PNG)</h2>


                            <form id="fileupload" action="<? echo base_url() . 'index.php/admin_j/do_upload'; ?>" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="span7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <span><i class="icon-plus icon-white"></i> Add files...</span>
                                            <input type="file" name="userfile" multiple>
                                        </span>
                                        <button type="submit" class="btn btn-primary start">
                                            <i class="icon-upload icon-white"></i> Start upload
                                        </button>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="icon-ban-circle icon-white"></i> Cancel upload
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="icon-trash icon-white"></i> Delete
                                        </button>
                                        <input type="checkbox" class="toggle">
                                    </div>
                                    <div class="span5">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-success progress-striped active fade">
                                            <div class="bar" style="width:0%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- The loading indicator is shown during image processing -->
                                <div class="fileupload-loading"></div>
                                <br>
                                <!-- The table listing the files available for upload/download -->
                                <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
                            </form>





                            <br>
                            <div class="well">
                                <h3>Demo Notes</h3>
                                <ul>
                                    <li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default file size is unlimited).</li>
                                    <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                                    <li>Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo setting).</li>
                                    <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage with Google Chrome, Mozilla Firefox and Apple Safari.</li>
                                    <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
                                    <li>Built with Twitter's <a href="http://twitter.github.com/bootstrap/">Bootstrap</a> toolkit and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
                                </ul>
                            </div>
                        </div>



                        <!-- modal-gallery is the modal dialog used for the image gallery -->
                        <div id="modal-gallery" class="modal modal-gallery hide fade">
                            <div class="modal-header">
                                <a class="close" data-dismiss="modal">&times;</a>
                                <h3 class="modal-title"></h3>
                            </div>
                            <div class="modal-body"><div class="modal-image"></div></div>
                            <div class="modal-footer">
                                <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
                                <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
                                <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
                                <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
                            </div>
                        </div>




                        <!-- The template to display files available for upload -->
                        <script id="template-upload" type="text/x-tmpl">
                            {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
                            <tr class="template-upload fade">
                                <td class="preview"><span class="fade"></span></td>
                                <td class="name">{%=file.name%}</td>
                                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                {% if (file.error) { %}
                                <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                                {% } else if (o.files.valid && !i) { %}
                                <td>
                                    <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                                </td>
                                <td class="start">{% if (!o.options.autoUpload) { %}
                                    <button class="btn btn-primary">
                                        <i class="icon-upload icon-white"></i> {%=locale.fileupload.start%}
                                    </button>
                                    {% } %}</td>
                                {% } else { %}
                                <td colspan="2"></td>
                                {% } %}
                                <td class="cancel">{% if (!i) { %}
                                    <button class="btn btn-warning">
                                        <i class="icon-ban-circle icon-white"></i> {%=locale.fileupload.cancel%}
                                    </button>
                                    {% } %}</td>
                            </tr>
                            {% } %}
                            </script>

                            <div id="download-files">
                            <!-- The template to display files available for download -->
                            <script id="template-download" type="text/x-tmpl">
                                {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
                                <tr class="template-download fade">
                                    {% if (file.error) { %}
                                    <td></td>
                                    <td class="name">{%=file.name%}</td>
                                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                    <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                                    {% } else { %}
                                    <td class="preview">{% if (file.thumbnail_url) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img width="100px" src="{%=file.thumbnail_url%}"></a>
                                        {% } %}</td>
                                    <td class="name">
                                        <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                                    </td>
                                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                    <td colspan="2"></td>
                                    {% } %}
                                    <td class="delete">
                                        <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                                            <i class="icon-trash icon-white"></i> {%=locale.fileupload.destroy%}
                                        </button>
                                        <input type="checkbox" name="delete" value="1">
                                    </td>

                                    <td class="add">
                                        <button class="btn btn-success add-article"  title="{%=file.name%}" data-type="PRIMARYIMAGE" data-url="{%=file.url%}">
                                            <i class="icon-plus icon-white"></i> Add 
                                        </button>

                                    </td>
                                </tr>
                                {% } %}

                               
                                </script>
                            </div>











                            </div>
                        </div>


                    </div>
                </div>

            </div><!--/span-->
        </div><!--/row-->

        <hr>

        <footer>
            <p>&copy; Company 2012</p>

        </footer>

    </div><!--/.fluid-container-->
    
    </body>
</html>
