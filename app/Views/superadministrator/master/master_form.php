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
                            <label for="master_name">Master_name</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_master_name_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_master_name"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="master_name" id="master_name" maxlength="250" placeholder="Master_name" value="<?php echo $data->master_name; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category_id</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_category_id_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_category_id"); ?></small></span>
                            <select class="form-control" id="category_id" name="category_id" placeholder="category_id">
                                <option value="<?php echo $data->category_id ?>"><?php echo $data->category_id ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_quantity_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_quantity"); ?></small></span>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $data->quantity; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_date_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_date"); ?></small></span>
                            <input type="date" class="form-control" name="date" id="date" value="<?php echo $data->date; ?>"  />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_description_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_description"); ?></small></span>
                            <textarea class="form-control" rows="3" name="description" id="description" maxlength="65535" placeholder="Description"  ><?php echo $data->description; ?></textarea>
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
