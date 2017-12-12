<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/10/2016
     * Time: 3:21 AM
     */
?>

<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center text-info">LOGIN</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" action="<?=PUBLIC_PATH?>index.php" method="post">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-1">
                            <label for="email" class="glyphicon glyphicon-envelope"></label>
                        </div>
                        <div class="col-md-5">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-1">
                            <label for="password" class="glyphicon glyphicon-asterisk"></label>
                        </div>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4">
                            <label class="radio-inline"><input type="radio" name="loginAs" value="student" required>Student</label>
                            <label class="radio-inline"><input type="radio" name="loginAs" value="lecturer" required>Lecturer</label>
                            <label class="radio-inline"><input type="radio" name="loginAs" value="admin" required>Admin</label>
                        </div>
                    </div>
                    <h4></h4>
                    <h4></h4>
                    <div class="form-group">
                        <br><br>
                        <div class="col-md-offset-5">
                            <button type="submit" class="btn btn-primary" name="login"><b>Login</b></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
