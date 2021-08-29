<?php
$this->extend($Template->container);
$this->section('content'); ?>
<div class="col-12">
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
                            <label for="master_id"><?php echo (lang('Text.SelectAssets', [], $Page->locale)) ?></label>&nbsp;<button type="button" class="btn btn-sm btn-default" id="btn-add-assets" title="<?php echo (lang('Tooltips.AddField', ['field' => 'Asset'], $Page->locale)) ?>"><i class="fa fa-plus text-primary"></i></button>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_master_id_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_master_id"); ?></small></span>
                            <select class="form-control" id="master_id" name="master_id" placeholder="master_id">
                                <option value="<?php echo $data->master_id ?>"><?php echo $data->master_id ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_quantity_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_quantity"); ?></small></span>
                            <input type="number" class="form-control" name="quantity" id="quantity" step=".000001" value="<?php echo $data->quantity; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_price_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_price"); ?></small></span>
                            <input type="number" class="form-control" name="price" id="price" value="<?php echo $data->price; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_description_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_description"); ?></small></span>
                            <textarea class="form-control" rows="3" name="description" id="description" maxlength="65535" placeholder="Description"><?php echo $data->description; ?></textarea>
                        </div>
                        <input type="hidden" id="oldid" class="form-control" name="oldid" style="display:none;" value="<?php echo $data->id ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent . '/index') ?>"><?php echo lang("Button.Cancel", [], $Page->locale) ?></a>
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