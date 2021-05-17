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

            <table class="table table-striped contact-list">
                <thead>
                    <th scope="col">#</th>
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
                <tbody>
                    <?php

                    $this->widget('zii.widgets.CListView', array(
                        'id' => 'contact-list',
                        'dataProvider' => $model->search(),
                        'itemView' => '_view',
                        // 'filter' => $model,
                        'enablePagination' => true,
                        'htmlOptions' => array(
                            // 'preItemsTag' => $pre_html,
                            // 'postItemsTag' => $post_html,
                        ),
                        'sortableAttributes' => array(
                            'first_name',
                            'last_name',
                            'city',
                            'state',
                            'country'
                        ),
                    ));

                    ?>
                </tbody>
            </table>

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