<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <?= $this->Html->css([
        'bootstrap.min.css',
        'miligram.min.css',
        'sidecss/style.css',
        'css/responsive.css',
        'css/jquery.mCustomScrollbar.min.css',           
    
        ]) ?>
</head>
<body>
<?php echo $this->element('sidebar')?>
<?php echo $this->element('nav')?>
<div class="users index content">
<div class="col-sm-3">
            <?php echo $this->Form->create(null,['type'=>'get']);?>
           <?php echo $this->Form->select(
                        'status',
                        [
                        
                            '0' => 'Inactive',
                            '1' => 'Active',
                        ],                        
                        ['empty' => 'Select status','id'=>"status",'style'=>'width:365px; height:30px; border-top-style: hidden;
                        border-right-style:hidden; border-left-style: hidden; border-bottom-style: groove','class'=>"form-control mr-sm-2",]
                    );?>
                     <?php echo $this->Form->control('',['placeholder'=>'Search car','id'=>'key','style'=>'width:365px; height:30px; border-top-style: hidden;
            border-right-style:hidden; border-left-style: hidden; border-bottom-style: groove; cursor: pointer','class'=>"form-control mr-sm-2",
            ]);?>
            <!-- <?php echo $this->Form->submit();?>  -->
            <?php echo $this->Form->end();?>
            </div>
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <?php echo $this->element('tabledata')?> 
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
    $('#status').on('change', function() {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
        //     }
        // });
        
        var data = $(this).val();
    //  alert(data);
        
        $.ajax({
            url: "http://localhost:8765/users/index",
            data: {'status':data},
            type: "json",
            method: "get",
            success:function(response){
                // code will work in case of json retun from the ajax start here
                res = JSON.parse(response);
                var tabel_html = '<table><thead><tr><th>id</th><th>name</th><th>email</th><th>status</th><th>created At</th><th> Actions</th></tr></thead>';
                tabel_html += '<tbody>';
                $.each(res, function (key, val1) {
                        tabel_html += '<tr><td>'+val1.id+'</td><td>'+val1.name+'</td><td>'+val1.email+'</td><td>'+val1.status+'</td><td>'+val1.created_at+'</td><td class="actions"></td></tr>';
                    // console.log(table_html);
                })
                
                tabel_html +='</tbody>';
                tabel_html +='</table>';
                $('.table-responsive').html(tabel_html);
                 // code will work in case of json retun from the ajax end here
                 
                // code will work in case cakephp element render start here \
                // $('.table-responsive').html(response);
                // code will work in case cakephp element render end here 
            }
        });
    });
    </script>
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