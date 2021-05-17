<?php
/* @var $this UserController */
/* @var $data User */
?>
<tr data-bs-toggle="modal" data-bs-target="#myModal" data-bs-comment="<?php echo CHtml::encode($data->comment); ?>" data-comment2="<?php echo CHtml::encode($data->comment_2); ?>" class="align-middle">
    <td>
        <input class="form-check-input" type="checkbox" value="" id="bulkCheck<?php echo $data->id; ?>">

        <?php
        // echo CHtml::checkBoxList(
        //         'bulk_contacts',
        //         (isset($_GET['bulk_contacts'])) ? $_GET['bulk_contacts'] : '',
        // null
        // ,
        // array(
        //     'class'=>'categoryFilter',
        // )
        // ); 
        ?>
    </td>
    <td><?php echo CHtml::encode($data->first_name); ?></td>
    <td><?php echo CHtml::encode($data->last_name); ?></td>
    <td><?php echo CHtml::encode($data->email); ?></td>
    <td><?php echo CHtml::encode($data->phone_number); ?></td>
    <td><?php echo CHtml::encode($data->zipcode); ?></td>
    <td><?php echo CHtml::encode($data->city); ?></td>
    <td><?php echo CHtml::encode($data->state); ?></td>
    <td><?php echo CHtml::encode($data->country); ?></td>
    <td>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh.
                        <?php echo CHtml::encode($data->comment_2); ?>
                    </div>
                </div>
            </div>
        </div>

    </td>
    <td><?php echo CHtml::encode($data->created_at); ?></td>
    <!-- <td width="120">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h5 class="accordion-header" id="panelsStayOpen-headingOne" style="width: 40px;">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">

                    </button>
                </h5>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <?php echo CHtml::encode($data->comment); ?>
                    </div>
                </div>
            </div>
        </div>

    </td> -->
</tr>