<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <?= $this->Html->css([
        'bootstrap.min.css',
        'sidecss/style.css',
        'css/responsive.css',
        'css/jquery.mCustomScrollbar.min.css',           
    
        ]) ?>
</head>
<body>
<?php echo $this->element('adduserside')?>
<?php echo $this->element('loginnav')?>

<div class="row">
   
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('name',['required'=>false]);
                    echo $this->Form->control('email',['required'=>false]);
                    echo $this->Form->control('password',['required'=>false]);                
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
jQuery.validator.addMethod("regex", function(value, element, param) {return value.match(new RegExp("^" + param + "$")); });
    var ALPHA_REGEX = "[a-zA-Z]*";
    
$(document).ready(function() {
    $("form").validate({
      rules: {
        name : {
          regex: ALPHA_REGEX,
          required: true,
          minlength: 2,
        },
        email :{
            required : true,
            email: true,
        },
       
        password: {
            required: true,
            minlength: 3
        },      
        
      
    },
     messages : {
        name: {
        regex : "Name should be only in letters",
        required: "Please enter your name",
        minlength: "Name should be at least 2 characters"
        },
       
        password : {
        required: "Please fill password",
        minlength: "Password should be atleast 5 characters long",
        },
       
        email :{
        required : "Please fill Email",
        email : "Please enter a valid email format"
        },
       
        
    },
   
})
})
</script>
</body>