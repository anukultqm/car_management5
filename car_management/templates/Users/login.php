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
<?php echo $this->element('loginnav')?>
<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('email', ['required'=>true]) ?>
        <?= $this->Form->control('password', ['required'=>true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("Add User", ['action' => 'add']) ?>
</div>
<script>
jQuery.validator.addMethod("regex", function(value, element, param) {return value.match(new RegExp("^" + param + "$")); });
    var ALPHA_REGEX = "[a-zA-Z]*";
    
$(document).ready(function() {
    $("form").validate({
      rules: {
      
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

        email :{
        required : "Please fill Email",
        email : "Please enter a valid email format"
        },   
       
        password : {
        required: "Please fill password",
        minlength: "Password should be atleast 5 characters long",
        },
       
        
       
        
    },
   
})
})
</script>
</body>