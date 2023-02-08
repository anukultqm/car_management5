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
<div class="cars index content">
<?php
                $session = $this->getRequest()->getSession();
                echo "<h2>Welcome</h2>"."<h3>".$result->email."</h3>";
            ?>
 <body>         

<div class="rating index content"> 
    <h3><?= __('Rating') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('car_id') ?></th>
                    <th><?= $this->Paginator->sort('rating') ?></th>
                    <th><?= $this->Paginator->sort('review') ?></th>
                   
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rating as $rating): ?>
                <tr>
                    <td><?= $this->Number->format($rating->id) ?></td>
                    <td><?= $rating->has('user') ? $this->Html->link($rating->user->name, ['controller' => 'Users', 'action' => 'view', $rating->user->id]) : '' ?></td>
                    <td><?= $rating->has('car') ? $this->Html->link($rating->car->name, ['controller' => 'Cars', 'action' => 'view', $rating->car->id]) : '' ?></td>
                 
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
                    <td><?= h($rating->review) ?></td>
             
                    <td><?= h($rating->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'ratingview', $rating->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'ratingedit', $rating->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'ratingdelete', $rating->id], ['confirm' => __('Are you sure you want to delete rating # {0}?', $rating->id)]) ?>
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
</body>