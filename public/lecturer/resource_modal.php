<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/27/2016
     * Time: 2:02 PM
     */
?>

<div id="resourceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center text-info">UPLOAD RESOURCE</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="<?=PUBLIC_PATH?>lecturer/week_page.php?course_id=<?=$course_id?>&week_id=<?=$week_id?>" method="post">
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="title" placeholder="Enter File Title" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="resource_type">Type</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-control" name="resource_type">
                                <option></option>
                                <option>Audio</option>
                                <option>Document</option>
                                <option>Image</option>
                                <option>Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="uploaded_file">Resource</label>
                        </div>
                        <div class="col-md-7">
                            <input type="file" name="uploaded_file">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="summary">Summary</label>
                        </div>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="5" name="summary" placeholder="File Summary Here..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-5">
                            <button type="submit" class="btn btn-primary" name="upload"><b>UPLOAD</b></button>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>-->
        </div>
    </div>
</div>
