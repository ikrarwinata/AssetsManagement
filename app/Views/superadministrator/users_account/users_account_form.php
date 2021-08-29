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
                            <label for="password">Password</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_password_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_password"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="password" id="password" maxlength="100" placeholder="Password" value="<?php echo $data->password; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="full_name">Full_name</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_full_name_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_full_name"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="full_name" id="full_name" maxlength="250" placeholder="Full_name" value="<?php echo $data->full_name; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="nick_name">Nick_name</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_nick_name_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_nick_name"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="nick_name" id="nick_name" maxlength="100" placeholder="Nick_name" value="<?php echo $data->nick_name; ?>" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_email_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_email"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="email" id="email" maxlength="100" placeholder="Email" value="<?php echo $data->email; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_phone_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_phone"); ?></small></span>
                            <input type="text" class="form-control" autocomplete="on" name="phone" id="phone" maxlength="50" placeholder="Phone" value="<?php echo $data->phone; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_level_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_level"); ?></small></span>
                            <input type="radio" name="level" id="level" value="<?php echo $data->level; ?>" required="true" />&nbsp;<label for="level">level</label>
                        </div>
                        <div class="form-group">
                            <label for="img">Img</label>&nbsp;<span class="<?php echo session()->getFlashdata("ci_flash_message_img_type"); ?>"><small><?php echo session()->getFlashdata("ci_flash_message_img"); ?></small></span>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <input type="hidden" id="oldimg" class="hide hidden d-none" name="oldimg" style="display:none;" value="<?php echo (isset($data->img) ? $data->img : NULL); ?>">
                                    <input type="file" name="img" id="img" accept="*" class="form-control">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <?php if (isset($data->img) && $data->img != NULL) : ?>
                                        <a href="<?php echo $data->img ?>" class="btn btn-md btn-default">File</a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldusername" class="form-control" name="oldusername" style="display:none;" value="<?php echo $data->username ?>">
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