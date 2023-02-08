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
<?php echo $this->element('sidebar')?>
<?php echo $this->element('nav')?>
<div class="row">
  
    <div class="column-responsive column-80">
        <div class="cars form content">
            <?= $this->Form->create($car,['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Edit Car') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users,'type'=>'hidden']);
                    echo $this->Form->control('brand_id', ['options' => $brands,'type'=>'hidden']);
                    echo $this->Form->control('name',['required'=>false]);
                    echo $this->Form->control('make',['required'=>false]);
                    echo $this->Form->control('model',['required'=>false]);
                    echo $this->Form->control('color',['required'=>false]);
                    echo $this->Form->control('description',['required'=>false]);
                    echo $this->Form->control('image_file',['type'=>'file','required'=>false]);
           
                    echo $this->Form->control('modified_at', ['empty' => false]);
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
        make :{
            required : true,
            minlength: 4
        },
       
        model: {
            required: true,
            minlength: 1
        },
        color : {        
          required: true,
        },      
        description : {        
          required: true,
        },      
        image_file : {        
          required: true,
        }, 
        
     
       
    },
     messages : {
        name: {
        regex : "Name should be only in letters",
        required: "Please enter your name",
        minlength: "Name should be at least 2 characters"
        },
       
        make : {
        required: "Please fill password",
        minlength: "Password should be atleast 5 characters long",
        },
       
        model :{
        required : "Please fill model",
        minlength: "model should be 1 characters",
        },
        color :{
        required : "Please fill color",
     
        },
        description :{
        required : "Please fill Description",
     
        },
        image_file :{
        required : "Please choose image",
     
        },
    
    },

})
})
</script>
   
</body>
