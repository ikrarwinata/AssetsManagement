<?php
$this->extend($Template->container);
$this->section('content'); ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $Page->title; ?></h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <?php if (session()->getFlashdata('ci_flash_message') != NULL) : ?>
    <div class="alert text-center mb-1 mt-0 <?php echo session()->getFlashdata('ci_flash_message_type') ?>" role="alert">
        <small><?php echo session()->getFlashdata('ci_flash_message') ?></small>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-body">
                    <table class="table table-light table-striped">
                        <tbody>
                            <tr>
                            <th width="15%">master_name</th><td>: <?php echo $data->master_name; ?></td>
                        </tr>
                            <tr>
                            <th width="15%">category_id</th><td>: <?php echo $data->category_id; ?></td>
                        </tr>
                            <tr>
                            <th width="15%">quantity</th><td>: <?php echo $data->quantity; ?></td>
                        </tr>
                            <tr>
                            <th width="15%">date</th><td>: <?php echo $data->date; ?></td>
                        </tr>
                            <tr>
                            <th width="15%">description</th><td>: <?php echo $data->description; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex p-2 bd-highlight">
                        <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent . '/index') ?>"><?php echo lang("Button.Cancel", [], $Page->locale) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
