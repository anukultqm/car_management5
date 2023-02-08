<div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>                 
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                   <?php  if($user->role == 0){
                    continue;
                }
                    ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td>
                                <?php if($user->status == '0'):?>
                                <?= $this->Form->postLink(__('Inactive'), ['action' => 'userstatus', $user->id,$user->status], ['confirm' => __('Are you sure you want to Active # {0}?', $user->id)]) ?>
                                <?php else:?>
                                <?= $this->Form->postLink(__('Active'), ['action' => 'userstatus', $user->id,$user->status], ['confirm' => __('Are you sure you want to Inactive # {0}?', $user->id)]) ?>
                                <?php endif;?>
                            </td>             
                    <td><?= h($user->created_at) ?></td>                 
                    <td class="actions">
                        <?= $this->Html->link(__(''), ['action' => 'view', $user->id],['class'=>"fa-sharp fa-solid fa-eye"]) ?>
                        <?= $this->Html->link(__(''), ['action' => 'edit', $user->id],['class'=>"fa-sharp fa-solid fa-pen-to-square"]) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id],['class'=>"fa-solid fa-trash"],['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->Form->end()?>
        <?= $this->fetch('postlink');?>
    </div>