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
<?php echo $this->element('usersidebar')?>
<?php echo $this->element('nav')?>
<div class="row">
  
    <div class="column-responsive column-80">
        <div class="rating view content">
        <div class="img">
                        <?= $this->Html->image($rating->car->image,['width' => '100px']);?>
                        </div>
            <h3><?= h($rating->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $rating->has('user') ? $this->Html->link($rating->user->name, ['controller' => 'Users', 'action' => 'view', $rating->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Car') ?></th>
                    <td><?= $rating->has('car') ? $this->Html->link($rating->car->name, ['controller' => 'Cars', 'action' => 'view', $rating->car->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating') ?></th>
                    
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
                            <?php echo $rating->rating." "?>
                            </td>
                </tr>
                <tr>
                    <th><?= __('Review') ?></th>
                    <td><?= h($rating->review) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($rating->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rating->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($rating->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
    
</body>