<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo CHtml::beginForm('?r=admin/contact/import', 'post', array('enctype' => 'multipart/form-data')); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">
                        Uploading a CSV file</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                    <div class="csv-input text-center">
                        
                        <?php echo CHtml::fileField('csv_file', '', 
                            array(
                                'class' => 'd-none',
                                'id' => 'loadFile',
                                'onchange' => 'console.log(this.files[0].name);',
                                'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'
                            )); 
                            ?>
                        <span class="btn btn-sm btn-primary" onclick="document.getElementById('loadFile').click();return;"> Select a file </span> 
                        <p class="footer-title _d-none">Only CSV allowed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo CHtml::hiddenField('import', '1'); ?> 
                    <?php echo CHtml::submitButton('Import', array('class' => 'btn btn-sm btn-primary' )); ?>
                </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>