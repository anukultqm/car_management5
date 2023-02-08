
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $brand->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $brand->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Brands'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="brands form content">
            <?= $this->Form->create($brand) ?>
            <fieldset>
                <legend><?= __('Edit Brand') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users,'type'=>'hidden']);
                    echo $this->Form->control('name',['required'=>false]);
                    echo $this->Form->control('description',['required'=>false]);
                   
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
