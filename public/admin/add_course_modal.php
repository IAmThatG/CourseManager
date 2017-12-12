<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 4:45 PM
     */
?>

<div id="addCourseModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center text-info">ADD COURSE</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="<?=PUBLIC_PATH?>admin/admin_home.php" method="post">
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="course_code">Course Code</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="course_code" placeholder="Enter Course Code" value="<?=$course->getCourseCode()?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="course_title">Course Title</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="course_title" placeholder="Enter Course Title" value="<?=$course->getCourseTitle()?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="course_unit">Course Unit:</label>
                        </div>
                       <div class="col-md-7">
                           <select class="form-control" name="course_unit">
                               <option><?=$course->getCourseUnit()?></option>
                               <option>0</option>
                               <option>1</option>
                               <option>2</option>
                               <option>3</option>
                               <option>4</option>
                               <option>5</option>
                               <option>6</option>
                               <option>7</option>
                               <option>8</option>
                               <option>9</option>
                           </select>
                       </div>
                   </div>
                   <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="course_img">Course Image</label>
                        </div>
                        <div class="col-md-7">
                            <img src="<?= COURSE_PIC_URL ?><?= $course->getCourseImg() ?>" class="img-responsive img-rounded" width="100" height="100">
                            <input type="file" name="course_img">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-4">
                            <label for="description">Course Description</label>
                        </div>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="5" name="description" placeholder="Describe Course"><?=$course->getDescription()?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-5">
                            <button type="submit" class="btn btn-primary" name="add_course"><b>Add Course</b></button>
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

