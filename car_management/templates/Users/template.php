

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>rento</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <?= $this->Html->css([
        'css/bootstrap.min.css',
        'css/style.css',
        'css/responsive.css',
        'css/jquery.mCustomScrollbar.min.css',           
    
        ]) ?>
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
   
      <!-- end loader -->
      <!-- header -->
      <?php echo $this->element('header');?>  
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <?php echo $this->element('banner');?>  
      <!-- end banner -->
      <!-- car -->
      <!-- <?php echo $this->element('cars');?>  -->
      <?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Car> $cars
 */
?>

<div class="container">
<div class="col-sm-2 mb-5">
<?php echo $this->Form->create(null,['type'=>'get']);
              echo $this->Form->control('',['placeholder'=>'Search car','id'=>'key','style'=>'width:365px; height:30px; border-top-style: hidden;
              border-right-style:hidden; border-left-style: hidden; border-bottom-style: groove','class'=>"form-control mr-sm-2",
              'value'=>$this->request->getQuery('key')]);
        
              echo $this->Form->end();?>
</div>

<div class="row">
        
                <?php foreach ($cars as $car): ?>
                    <?php if($car->status ==  '0'){
                    continue;
                } ?>
                    <div class="col-lg-4 carslist">
                        <div class="trainer-item">
                            <div class="image-thumb">
                                <img> <?= $this->Html->image($car->image,['width' => '300px'])?>
                            </div>
                            <div class="down-content">
                                <span>
                                    Model
                                    <?= h($car->model) ?>
                                    &nbsp;
                                </span>
                                <h4> Name:
                                    <?= h($car->name) ?>
                                </h4>
                                <p>
                                <h5>Make</h5>
                                    (
                                    <?= h($car->make) ?>)
                                    &nbsp;&nbsp;&nbsp;
                                </p>
                                <p>
                                <h5>Description</h5>
                                    <?= h($car->description) ?>
                                </p>
                                <ul class="social-icons">
                                    <?= $this->Html->link(__('More details'), ['action' => 'usercarview', $car->id],['class' => 'btn-success']) ?>
                                    <!-- <?= $this->Html->link(__('Post Review'), ['action' => 'ratingview', $car->id],['class' => 'btn-success']) ?> -->

                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
</div>

 
      <!-- end car -->
      <!-- bestCar -->
      <!-- <?php echo $this->element('bestcar');?>   -->
      <!-- end bestCar -->
      <!-- choose  section -->
      <?php echo $this->element('choose');?>  
      
      <!-- end choose  section -->
      <!-- cutomer -->
      <?php echo $this->element('customer');?>  
      
      <!-- end cutomer -->
      <!--  footer -->
      <?php echo $this->element('footer');?>  
      
      <!-- end footer -->
      <!-- Javascript files-->
      <?= $this->Html->script([
      'car_js/jquery.min.js',
      'car_js/popper.min.js',
      'car_js/bootstrap.bundle.min.js',
      'car_js/jquery-3.0.0.min.js',
      'car_js/plugin.js',
      'car_js/jquery.mCustomScrollbar.concat.min.js',
      'car_js/custom.js',
    ]);?>
 <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <!-- sidebar -->
      <script>

    $(document).ready(function(){
        $("#key").on("keyup", function() {  
            var value = $(this).val().toLowerCase();  
            $(".carslist").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
});

</script>
   </body>
</html>

