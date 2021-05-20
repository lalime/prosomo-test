<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Contacts',
);

$this->menu = array(
    // array('label'=>'Create User', 'url'=>array('create')),
    array('label' => 'List Messages', 'url' => array('admin')),
);
$baseUrl = Yii::app()->baseUrl;

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.upload-button').click(function(){
        $('.upload-form').toggle();
        return false;
    });
    
    $('.search-form form').submit(function(){
        $('#contact-list').yiiListView('update', {
            data: $(this).serialize()
        });
        return false;
    });

    $('#delete_selected_items_button').on('click', function () {
        var selected = $.fn.yiiGridView.getSelection('contacts-grid')
    
        // if nothing's selected
        if ( ! selected.length)
        {
            alert('Please select minimum one contact to be deleted');
            return false;
        }
    
        //confirmed?
        if ( ! confirm('Are you sure to delete ' + selected.length + ' contacts?')) return false;
    
        var multipledeleteUrl = '$baseUrl/index.php?r=admin/contact/bulkdelete';
    
        $.ajax({
            type: 'POST',
            url: multipledeleteUrl,
            data: {selectedContacts : selected},
            success: (function (e){
    
                //we refresh the CCGridView after success deletion
                $.fn.yiiGridView.update('contacts-grid');
    
            }),
            error: (function (e) {
                alert('Can not delete selected contacts');
            })
        });
    })
");

// echo CHtml::scriptFile(Yii::app()->request->baseUrl . '/js/app.js');
?>

<div class="container h-75" id="page">
    <section class="my-5">
        <div class="p-3 m-auto">
            <h1 class="_mb-5">Contacts</h1>

            <div class="row justify-content-between pt-5 pb-3">
            <?php if(Yii::app()->user->hasFlash('success')):?>
                <div class="alert alert-success" role="alert">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            
            <div class="row justify-content-between pt-5 pb-3">
                <div class="col-8">
                    <div id="search-block" class="">
                        <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>

                        <div class="search-form" style="display:none">
                            <?php $this->renderPartial('_search', array(
                                'model' => $model,
                            )); ?>
                        </div><!-- search-form -->
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-success upload-button" type="button" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload</button>
                </div>
            </div>
            <div>
                <button type="button" id="delete_selected_items_button" class="btn btn-danger">Delete selected items</button>
            </div>
<?php

    $pre_html = '<table class="table table-striped contact-list caption-top">
                <caption>List of messages</caption>
                <thead>
                    <th scope="col">
                    
                    </th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                    <th scope="col">Comment 2</th>
                    <th scope="col">Sent On</th>
                </thead>
                <tbody>';

    $post_html = '</tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="10" class="align-right">
                    <a href="#" id="delete_selected_items_button" class="link-danger">Supprimer la selection</a>
                </td>
            </tr>
        </tfoot>
    </table>';


    // $this->widget('zii.widgets.CListView', array(
    //     'id' => 'contact-list',
    //     'dataProvider' => $model->search(),
    //     'itemView' => '_view',
    //     // 'filter' => $model,
    //     'htmlOptions' => array(
    //         'preItemsTag' => $pre_html,
    //         'postItemsTag' => $post_html,
    //     ),
    //     'enablePagination' => true,
    //     'sortableAttributes' => array(
    //         'first_name',
    //         'last_name',
    //         'city',
    //         'state',
    //         'country'
    //     ),
    // ));
    $this->widget('zii.widgets.grid.CGridView', array
        (
            'id' => 'contacts-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'class'=>'CCheckBoxColumn',
                ),
                'first_name',
                'last_name',
                array(
                    'name'=>'email',
                    'sortable' => false,
                ),
                array(
                    'name'=>'phone_number',
                    'filter' => false,
                    'sortable' => false,
                ),
                array(
                    'name'=>'city',
                    'filter' => CHtml::listData(Contact::model()->findAll(), 'city','city'),
                ),
                array(
                    'name'=>'state',
                    'filter' => CHtml::listData(Contact::model()->findAll(), 'state','state'),
                ),
                array(
                    'name'=>'zipcode',
                    'filter' => false,
                    'sortable' => false,
                ),
                array(
                    'name'=>'country',
                    'filter' => CHtml::listData(Contact::model()->findAll(), 'country','country'),
                ),
                array(
                    'name'=>'comment_2',
                    'type'=>'raw',
                    'filter' => false,
                    'sortable' => false,
                    'value' => function($data,$row) {
                        // also allows us to use outside (external) variables, that are not defined within grid,
                        return '<div class="accordion" id="accordionComment'. $data->id .'">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading'. $data->id .'">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'. $data->id .'" aria-expanded="true" aria-controls="collapse'. $data->id .'">
            
                                </button>
                            </h2>
                            <div id="collapse'. $data->id .'" class="accordion-collapse collapse" aria-labelledby="heading'. $data->id .'" data-bs-parent="#accordionComment'. $data->id .'">
                                <div class="accordion-body">'. CHtml::encode($data->comment_2) .'</div>
                            </div>
                        </div>
                    </div>';
                    }
                ),
            ),
            'filter' => $model,
            'enablePagination' => true,
            'enableSorting' => true,
            'itemsCssClass' => 'table table-striped contact-list',
            'selectableRows' => 10,
            'htmlOptions' => array(
                'class' => 'table-responsive'
            ),
            'rowHtmlOptionsExpression' => 'array(
                "data-id"=>$data->id,
                "data-bs-toggle" => "modal",
                "data-bs-target" => "#myModal",
                "data-bs-comment" => CHtml::encode($data->comment),
            )',
        )
    );

    ?>


            <div class="modal" tabindex="-1" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer d-none">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->renderPartial('_upload_form', array()); // 'form'=>$form ?>

        </div><!-- content -->
    </section><!-- form -->
</div><!-- container -->

<script>
    var myModal = document.getElementById('myModal')

    myModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var comment = button.getAttribute('data-bs-comment')
        // Update the modal's content.
        var modalBodyInput = myModal.querySelector('.modal-body')

        modalBodyInput.innerHTML = comment
    })
</script>