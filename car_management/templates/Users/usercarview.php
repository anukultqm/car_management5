<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
            <div class="cars view content">
                <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Rating</button>
                <?= $this->Html->image($car->image,['width' => '100px']);?>
                <h3>
                    <?= h($car->name) ?>
                </h3>
                <table>
                    <tr>
                        <th>
                            <?= __('User') ?>
                        </th>
                        <td>
                            <?= $car->has('user') ? $this->Html->link($car->user->name, ['controller' => 'Users', 'action' => 'view', $car->user->id]) : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Brand') ?>
                        </th>
                        <td>
                            <?= $car->has('brand') ? $this->Html->link($car->brand->name, ['controller' => 'Brands', 'action' => 'view', $car->brand->id]) : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Name') ?>
                        </th>
                        <td>
                            <?= h($car->name) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Make') ?>
                        </th>
                        <td>
                            <?= h($car->make) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Model') ?>
                        </th>
                        <td>
                            <?= h($car->model) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Color') ?>
                        </th>
                        <td>
                            <?= h($car->color) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Description') ?>
                        </th>
                        <td>
                            <?= h($car->description) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Image') ?>
                        </th>
                        <td>
                            <?= h($car->image) ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?= __('Created At') ?>
                        </th>
                        <td>
                            <?= h($car->created_at) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?= __('Modified At') ?>
                        </th>
                        <td>
                            <?= h($car->modified_at) ?>
                        </td>
                    </tr>
                </table>
                <div class="related">
                    <h4>
                        <?= __('Related Rating') ?>
                    </h4>
                    <?php if (!empty($car->rating)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>

                                <th colspan="1">
                                    <?= __('Rating') ?>
                                </th>
                                <th>
                                    <?= __('Review') ?>
                                </th>

                                <th>
                                    <?= __('Created At') ?>
                                </th>

                            </tr>
                            <?php foreach ($car->rating as $rating) : ?>
                            <tr>
                                <!-- <td><?= h($rating->id) ?></td>
                            <td><?= h($rating->user_id) ?></td> -->
                                <!-- <td><?= h($rating->car_id) ?></td> -->

                                <td width="50%" colspan="1"><span class="rate">
                                        <?php
                                                for ($i = 0; $i < $rating->rating; $i++) {
                                                    echo '<li class="fa-solid fa-star" value="1"></li>';
                                                }
                                                for ($j = $i; $j < 5; $j++) {
                                                    echo '<li class="fa-regular fa-star" value="1"></li>';
                                                }
                                                ?>
                                    </span>

                                </td>
                                <td>
                                    <?= h($rating->review) ?>
                                </td>

                                <td>
                                    <?= h($rating->created_at) ?>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ratings</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->Form->create($rating) ?>
                    <label for="">Rating</label>
                    <div class="mb-3">
                        <div class="rate">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        
                        <?php                   
                    echo $this->Form->control('car_id',['value'=>$car->id,'type'=>'hidden']);
                    
                 
                    echo $this->Form->control('review',['type' => 'textarea','required'=>false, 'label'=>false,'value'=>false]);                  
                    ?>
                        <?= $this->Form->button(__('Submit',['class'=>"btn-primary"])) ?>
                        <?= $this->Form->end() ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                 
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>