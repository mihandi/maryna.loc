<?php
function err($errors)
{
    foreach ($errors as $error){
        echo "<div class=\"help-block help-block-error \" style='color: #a94442'> $error </div>";
    }
}
?>

<div class="modal-body" id="form">
    <form method="post" action="/site/login">
        <div class="form-group">
            <label  class="form-control-label">Login/Email:</label>
            <input type="text" class="form-control" name="LoginForm[login]" id="login">
            <?php if(isset($model->errors['login'])):?>
                <?php err($model->errors['login']); ?>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label  class="form-control-label">Password:</label>
            <input type="password" class="form-control" name="LoginForm[password]" id="password">
            <?php if(isset($model->errors['password'])):?>
                <?php err($model->errors['password']); ?>
            <?php endif;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="submit" class="btn btn-primary">Send message</button>
        </div>
    </form>
</div>

<script>
    $( document ).ready(function() {
        $( "form" ).submit(function( event ) {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: '/site/login',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(html){
                    $('#form').html(html);
                }
            });
        });
    });
</script>
