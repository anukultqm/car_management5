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
        <div class="rating form content">
            <?= $this->Form->create($rating) ?>
            <fieldset>
                <legend><?= __('Edit Rating') ?></legend>
                <?php                  
                    echo $this->Form->control('rating',['required'=>false]);
                    echo $this->Form->control('review',['required'=>false]);
                   
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
            </body>