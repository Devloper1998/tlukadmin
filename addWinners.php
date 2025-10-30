<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
$selEvent = "select * from tluk_events";
$getEvents  = $crud->getData($selEvent);
$selEventCategory = "select * from tluk_eventcategories";
$getEventCategory = $crud->getData($selEventCategory);
$selSponsor = "select * from tluk_sponsors";
$getSponsor = $crud->getData($selSponsor);
?>



<body>
    <div id="layout-wrapper">

        <?php include('includes/navbar.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Add Winners</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add Winners</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end breadcrumb -->

                    <!-- Page Content -->
                    <div class="row">
                        <!-- <div class="col-md-2"></div> -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Add Product</h4> -->
                                    <!-- <form name="addformpage" id="addformpage" method="post"
                                        enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Winner Name <span class="star">*</span></label>
                                                    <input type="text" name="winner_name" id="winner_name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name <span class="star">*</span></label>
                                                    <select name="event_name" id="event_name" class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getEvents as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['event_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Gift <span class="star">*</span></label>
                                                    <input type="text" name="gift" id="gift" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Name <span class="star">*</span></label>
                                                    <select name="sponsor_name" id="sponsor_name" class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getSponsor as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['sponsor_name']?></option>
                                                        <?php
                                                    }?>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWinners.php'">Cancel</button>
                                            </div>
                                            <div class="col-6">

                                                <input type="submit" name="submit" value="Save" id="save"
                                                    class="btn btn-primary float-right">
                                            </div>
                                        </div>

                                    </form> -->
                                    <form name="addformpage" id="addformpage" method="post"
                                        enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name <span class="star">*</span></label>
                                                    <select name="event_name" id="event_name" class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getEvents as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['event_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Category <span class="star">*</span></label>
                                                    <select name="eventcategory_name" id="eventcategory_name"
                                                        class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getEventCategory as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['category_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="broucher_hide">
                                                <table class="table table-bordered table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Winner Name</th>
                                                            <th>Gift</th>
                                                            <th>Sponsor Name</th>
                                                            <th>Winner Image</th>
                                                            <th>Winner Order</th>
                                                            <th></th>
                                                        </tr>

                                                    </thead>
                                                    <tbody class="table1">
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <input type="text" name="winner_name[]"
                                                                            id="winner_name" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <input type="text" name="gift[]" id="gift"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <select name="sponsor_name[0][]"
                                                                            id="sponsor_name0"
                                                                            class="form-control sponsor-select"
                                                                            multiple>
                                                                            <option value="">--select option--</option>
                                                                            <?php foreach ($getSponsor as $key => $value) { ?>
                                                                            <option value="<?php echo $value['id'] ?>">
                                                                                <?php echo $value['sponsor_name']?>
                                                                            </option>
                                                                            <?php }?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><input type="file" name="image[]" id="image"
                                                                    class="form-control"></td>
                                                            <td><input type="text" class="form-control"
                                                                    name="winnerOrder[]" id="winnerOrder"></td>
                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-info addRow">+</a>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWinners.php'">Cancel</button>
                                            </div>
                                            <div class="col-6">

                                                <input type="submit" name="submit" value="Save" id="save"
                                                    class="btn btn-primary float-right">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- End Page Content -->

                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

<script type="text/javascript" src="js/winner.js"></script>
<script>
function addrow() {
    let count = $('.table1 tr').length;
    var addTr = ` <tr style="margin:10px 0px">
   <td><span id="counter">${count+1}</span></td>
  <td>
   <div class="col-12">
        <div class="form-group">
        <input type="text" name="winner_name[]"
            id="winner_name${count+1}" class="form-control">
        </div>
        </div>
    </td>
    <td>
    <div class="col-12">
        <div class="form-group">
            <input type="text" name="gift[]" id="gift${count+1}"
                class="form-control">
        </div>
    </div>
    </td>
    <td>
   <div class="col-12">
    <div class="form-group">
        <select name="sponsor_name[${count}][]" id="sponsor_name${count+1}" class="form-control sponsor-select" multiple>
                <option value="">--select option--</option>
                <?php foreach ($getSponsor as $key => $value) { ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['sponsor_name']?></option>
                <?php } ?>
            </select>
    </div>
</div>
    </td>
    <td><input type="file" name="image[]" id="image${count+1}" class="form-control"></td>
    <td><input type="text" class="form-control" name="winnerOrder[]" id="winnerOrder${count+1}"></td>
    <td style="text-align: center;"><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
    <td style="text-align: center;"><a href="javascript:void(0)"class="btn btn-info addRow" onclick ="add()">+</a></td>
   </tr>`;

    $('tbody.table1').append(addTr);
    $('.sponsor-select').select2({
        placeholder: "Select one or more sponsors"
    });
};


$('.addRow').on('click', function() {
    addrow();

});

function add() {
    addrow();
}

$('tbody').on('click', '.remove', function() {
    //    $(this).parent().parent().remove();
    $(this).parent().parent().remove();
    $('.table1 tr').each(function(i) {
        $(this).find('td')[0].innerHTML = i + 1;
    })

});
$(document).ready(function() {
    $('.sponsor-select').select2({
        placeholder: "Select one or more sponsors"
    });
});
</script>


</html>