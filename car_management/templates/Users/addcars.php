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

    <div class="column-responsive column-80">
        <div class="cars form content">
            <?= $this->Form->create($car,['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Add Car') ?></legend>
                <?php
                   
                    echo $this->Form->control('brand_id', ['options' => $brands,'type'=>'hidden']);
                    echo $this->Form->control('name',['required'=>false]);
               
                    echo '<label for="make">Make</label>';
                    echo $this->Form->select(
                      'make',
                      [                       
                          '2015' => '2015',
                          '2016' => '2016',
                          '2017' => '2017',
                          '2018' => '2018',
                          '2019' => '2019',
                          '2020' => '2020',
                          '2021' => '2021',
                          '2022' => '2022',
                          '2023' => '2023',
                      ],
                      ['empty' => 'Select year'],
                      ['required'=>false]
                  );
           
                    echo '<label for="model">Model</label>';
                    echo $this->Form->select(
                        'model',
                        [
                            'Top' => 'Top',
                            'Base' => 'Base',
                            'Standard' => 'Standard',
                        ],
                        ['empty' => 'Select car model'], ['required'=>false]
                    );
                  
                    echo '<label for="color">Color</label>';
                    echo $this->Form->select(
                        'color',
                        [
                            'Red' => 'Red',
                            'Black' => 'Black',
                            'White' => 'White',
                        ],
                        ['empty' => 'Select car color'],['required'=>false]
                    );
                    echo $this->Form->control('description',['required'=>false,'type' => 'textarea']);
                    echo $this->Form->control('image_file',['type'=>'file','required'=>false]);                
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
        }
    },
     messages : {
        name: {
        regex : "Name should be only in letters",
        required: "Please enter your name",
        minlength: "Name should be at least 2 characters"
        }
    }
})
})
</script>

</body>
