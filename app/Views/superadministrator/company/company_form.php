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
                            <label for="index_key">Index_key</label>&nbsp;<code>*</code>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_index_key_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_index_key"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="index_key" id="index_key" maxlength="150" placeholder="Index_key" value="<?php echo $data->index_key; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="com_value">Com_value</label>&nbsp;<code>*</code>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_com_value_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_com_value"); ?></small></span>
                            <textarea class="form-control" rows="3" name="com_value" id="com_value" maxlength="65535" placeholder="Com_value" required="true" ><?php echo $data->com_value; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="com_text">Com_text</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_com_text_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_com_text"); ?></small></span>
                            <textarea class="form-control" rows="3" name="com_text" id="com_text" maxlength="65535" placeholder="Com_text"  ><?php echo $data->com_text; ?></textarea>
                        </div>
                        <input type="hidden" id="oldindex_key" class="form-control" name="oldindex_key" style="display:none;" value="<?php echo $data->index_key ?>">
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
