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
<div class="cars index content">
<h3><?= __('Cars') ?></h3>
            <div class="col-sm-3">
            <?php echo $this->Form->create(null,['type'=>'get']);?>
           
            <?php echo $this->Form->control('',['placeholder'=>'Search car','id'=>'key','style'=>'width:365px; height:30px; border-top-style: hidden;
            border-right-style:hidden; border-left-style: hidden; border-bottom-style: groove','class'=>"form-control mr-sm-2",
            ]);?>
            <!-- <?php echo $this->Form->submit();?> -->
            <?php echo $this->Form->end();?>
            </div>
    <?= $this->Html->link(__('New Car'), ['action' => 'addcars'], ['class' => 'button btn-success float-right']) ?>
    <?= $this->Html->link(__('Add brands'), ['action' => 'addbrand'], ['class' => 'button btn-success float-right']) ?>
    
  
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('brand_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('make') ?></th>
                    <th><?= $this->Paginator->sort('model') ?></th>
                    <th><?= $this->Paginator->sort('color') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>                   
                    <th><?= $this->Paginator->sort('status') ?></th>                   
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach ($cars as $car): ?>               

                <tr>
                    <td><?= $this->Number->format($car->id) ?></td>
                    <td><?= h($car->user->name)?></td>
                    <td><?= h($car->brand->name) ?></td>
                    <td><?= h($car->name) ?></td>
                    <td><?= h($car->make) ?></td>
                    <td><?= h($car->model) ?></td>
                    <td><?= h($car->color) ?></td>
                    <td><?= h($car->description) ?></td>                    
                    <td>
                        <div class="img">
                        <?= $this->Html->image($car->image,['width' => '100px']);?>
                        </div>
                    </td>
                    <td>
                                <?php if($car->status == '0'):?>
                                <?= $this->Form->postLink(__('Inactive'), ['action' => 'carstatus', $car->id,$car->status], ['confirm' => __('Are you sure you want to Active # {0}?', $car->id)]) ?>
                                <?php else:?>
                                <?= $this->Form->postLink(__('Active'), ['action' => 'carstatus', $car->id,$car->status], ['confirm' => __('Are you sure you want to Inactive # {0}?', $car->id)]) ?>
                                <?php endif;?>
                            </td>
                  
                    <td><?= h($car->created_at) ?></td>
                    <td><?= h($car->modified_at) ?></td>
                    <td colspan="2" class="actions">
                        <?= $this->Html->link(__(''), ['action' => 'carview',$car->id],['class'=>"fa-sharp fa-solid fa-eye"]) ?>
                        <?= $this->Html->link(__(''), ['action' => 'caredit', $car->id],['class'=>"fa-sharp fa-solid fa-pen-to-square"]) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'cardelete', $car->id],['class'=>"fa-solid fa-trash"], ['confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<script>

$(document).ready(function(){
  $("#key").on("keyup", function() {  
    var value = $(this).val().toLowerCase();  
    $("tr").filter(function() {
     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
 </body>
