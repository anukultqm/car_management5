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
        <div class="cars view content">
            <div class="img">
             <?= $this->Html->image($car->image,['width' => '100px']);?>
            </div>
            <h3><?= h($car->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $car->has('user') ? $this->Html->link($car->user->name, ['controller' => 'Users', 'action' => 'view', $car->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= $car->has('brand') ? $this->Html->link($car->brand->name, ['controller' => 'Brands', 'action' => 'view', $car->brand->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($car->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Make') ?></th>
                    <td><?= h($car->make) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($car->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($car->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($car->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($car->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($car->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($car->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($car->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($car->modified_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Rating') ?></h4>
                <?php if (!empty($car->rating)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Car Id') ?></th>
                            <th><?= __('Rating') ?></th>
                            <th><?= __('Review') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <!-- <th class="actions"><?= __('Actions') ?></th> -->
                        </tr>
                        <?php foreach ($car->rating as $rating) : ?>
                        <tr>
                            <td><?= h($rating->id) ?></td>
                            <td><?= h($rating->user_id) ?></td>
                            <td><?= h($rating->car_id) ?></td>                          
                            <td><span class="rate">
                                                <?php
                                                for ($i = 0; $i < $rating->rating; $i++) {
                                                    echo '<li class="fa-solid fa-star" value="1"></li>';
                                                }
                                                for ($j = $i; $j < 5; $j++) {
                                                    echo '<li class="fa-regular fa-star" value="1"></li>';
                                                }
                                                ?>
                            </span>
                            <?= h($rating->rating) ?>
                            </td>
                            <td><?= h($rating->review) ?></td>
                            <td><?= h($rating->status) ?></td>
                            <td><?= h($rating->created_at) ?></td>
                            <!-- <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rating', 'action' => 'view', $rating->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rating', 'action' => 'edit', $rating->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rating', 'action' => 'delete', $rating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id)]) ?>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    
</body>