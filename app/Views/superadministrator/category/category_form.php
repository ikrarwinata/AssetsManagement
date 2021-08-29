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
                    <form action="<?php echo $action ?>" method="post">
                        <div class="form-group">
                            <label for="category_name">Category_name</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_category_name_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_category_name"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="category_name" id="category_name" maxlength="250" placeholder="Category_name" value="<?php echo $data->category_name; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="category_detail">Category_detail</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_category_detail_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_category_detail"); ?></small></span>
                            <textarea class="form-control" rows="3" name="category_detail" id="category_detail" maxlength="65535" placeholder="Category_detail"  ><?php echo $data->category_detail; ?></textarea>
                        </div>
                        <input type="hidden" id="oldid" class="form-control" name="oldid" style="display:none;" value="<?php echo $data->id ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent.'/index') ?>"><?php echo lang("Button.Cancel", [], $Page->locale) ?></a>
                                <button class="btn btn-sm btn-primary" type="submit"><?php echo lang("Button.Save", [], $Page->locale) ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
