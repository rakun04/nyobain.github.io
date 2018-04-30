<center><h2>Register</h2></center>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if(validation_errors()){
        ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php
        } ?>
        <form action="<?php echo base_url(); ?>blog/submit" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Name</label>
                <div class="col-md-10">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-md-2">Email</label>
                <div class="col-md-10">
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 image">
                    <?php echo $captcha; ?>
                </div>
                <div class="col-md-6">
                    <a class="refresh" href="javascript:;"><img src="<?php echo base_url(); ?>images/refresh.png"> </a>
                </div>
            </div>
            <div class="form-group">
                <label for="captcha" class="col-md-2 control-label">Captcha</label>
                <div class="col-md-10">
                    <input class="form-control" name="captcha">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        $('.refresh').click(function(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>index.php/blog/refresh_captcha',
                success: function(res){
                    if(res){
                        $('.image').html(res);
                    }
                }
            })
        });
    });
</script>