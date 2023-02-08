<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
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
        <div class="users view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($user->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $this->Number->format($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($user->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($user->modified_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Brands') ?></h4>
                <?php if (!empty($user->brands)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Modified At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->brands as $brands) : ?>
                        <tr>
                            <td><?= h($brands->id) ?></td>
                            <td><?= h($brands->user_id) ?></td>
                            <td><?= h($brands->name) ?></td>
                            <td><?= h($brands->description) ?></td>
                            <td><?= h($brands->status) ?></td>
                            <td><?= h($brands->created_at) ?></td>
                            <td><?= h($brands->modified_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $brands->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'brandedit', $brands->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Brands', 'action' => 'branddelete', $brands->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brands->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Cars') ?></h4>
                <?php if (!empty($user->cars)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Brand Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Make') ?></th>
                            <th><?= __('Model') ?></th>
                            <th><?= __('Color') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Modified At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->cars as $cars) : ?>
                        <tr>
                            <td><?= h($cars->id) ?></td>
                            <td><?= h($cars->user_id) ?></td>
                            <td><?= h($cars->brand_id) ?></td>
                            <td><?= h($cars->name) ?></td>
                            <td><?= h($cars->make) ?></td>
                            <td><?= h($cars->model) ?></td>
                            <td><?= h($cars->color) ?></td>
                            <td><?= h($cars->description) ?></td>
                            <td><?= h($cars->image) ?></td>
                            <td><?= h($cars->status) ?></td>
                            <td><?= h($cars->created_at) ?></td>
                            <td><?= h($cars->modified_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'carview', $cars->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'caredit', $cars->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cars', 'action' => 'delete', $cars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cars->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rating') ?></h4>
                <?php if (!empty($user->rating)) : ?>
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
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->rating as $rating) : ?>
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
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'ratingview', $rating->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'ratingedit', $rating->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rating', 'action' => 'ratingdelete', $rating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id)]) ?>
                            </td>
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