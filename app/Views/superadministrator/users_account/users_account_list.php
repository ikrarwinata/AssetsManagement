<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3">
            <?php echo form_open_multipart(base_url($Page->parent . '/fromExcel'), 'class="form-inline"'); ?>
            <a href="<?php echo base_url($Page->parent . '/create') ?>" class="btn btn-sm btn-primary"><?php echo lang("Button.CreateData", [], $Page->locale) ?></a>&nbsp;
            <!--IMPORTEXCELFILE-->
            <input type="file" name="excel_file" class="hide hidden d-none visible-none" data-clicked="false" onchange="javascript: {if($(this).val()!=null && $(this).attr('data-clicked')=='true'){return $(this).closest('form').find('button[type=submit]').click();}}">
            <button type="button" class="btn btn-sm btn-warning ml-2" onclick="$(this).closest('form').find('input[type=file]').eq(0).attr('data-clicked', 'true'); return $(this).closest('form').find('input[type=file]').eq(0).click();">
                Import Excel File
            </button>&nbsp;
            <button type="submit" class="hide hidden d-none visible-none" onclick="return $(this).closest('form').find('input[type=file]').eq(0).attr('data-clicked');">importexcelfile</button>
            <!--ENDIMPORTEXCELFILE-->
            <!--EXPORTBUTTONS-->
            <div class="dropdown">
                <button class="btn btn-sm btn-info dropdown-toggle ml-2 <?php echo (count($data) == 0 ? 'disabled' : NULL) ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!--EXPORTTOEXCEL-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/toExcel') ?>">Export Excel</a>
                    <!--ENDEXPORTTOEXCEL-->
                    <!--EXPORTTOWORD-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/toWord') ?>">Export Word</a>
                    <!--ENDEXPORTTOWORD-->
                    <!--EXPORTTOPDF-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/toPdf') ?>" target="_blank">Export Pdf</a>
                    <!--ENDEXPORTTOPDF-->
                    <!--PRINTALL-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/printAll') ?>" target="_blank">Print All</a>
                    <!--ENDPRINTALL-->
                </div>
            </div>
            <!--ENDEXPORTBUTTONS-->
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <form action="<?php echo base_url($Page->parent . '/index') ?>" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" value="<?php echo $keyword; ?>">
                    <span class="input-group-btn">
                        <?php if ($keyword <> '') : ?>
                            <a href="<?php echo base_url($Page->parent . '/index') ?>" class="btn btn-default"><?php echo lang("Button.ResetSearch", [], $Page->locale) ?></a>
                        <?php endif; ?>
                        <button class="btn btn-primary" type="submit"><?php echo lang("Button.SearchData", [], $Page->locale) ?></button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="<?php echo base_url($Page->parent . '/index') ?>" class="form-inline" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <?php echo lang("Default.perPage", [], $Page->locale) ?>
                        </div>
                    </div>
                    <input type="number" class="form-control" min="2" max="9999999999" name="perPage" value="<?php echo $perPage ?>">
                    <button class="btn btn-secondary" type="submit"><?php echo lang("Button.Show", [], $Page->locale) ?></button>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('ci_flash_message') != NULL) : ?>
        <div class="alert text-center mb-1 mt-0 <?php echo session()->getFlashdata('ci_flash_message_type') ?>" role="alert">
            <small><?php echo session()->getFlashdata('ci_flash_message') ?></small>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <h2>Data <?php echo $Page->title; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <br>
                    <form action="<?php echo (site_url($Page->parent . '/deleteBatch')) ?>" method="post">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="60px" class="text-center">#</th>
                                            <th class="align-middle" width="40px"><input type="checkbox" class="" checked="true"></th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('password') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "password") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Password
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('full_name') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "full_name") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Full_name
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('nick_name') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "nick_name") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Nick_name
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('email') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "email") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Email
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('phone') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "phone") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Phone
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo base_url($Page->parent . '/index?sortcolumn=' . base64_encode('level') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC')); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "level") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Level
                                                </a>
                                            </th>
                                            <th width="80px">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                    <?php
                                    $counter = $start;
                                    foreach ($data as $value) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter++ ?></td>
                                            <td class="align-middle"><input type="checkbox" class="" name="removeme[]" value="<?php echo $value->username ?>" checked="true"></td>
                                            <td><?php echo $value->password ?></td>
                                            <td><?php echo $value->full_name ?></td>
                                            <td><?php echo $value->nick_name ?></td>
                                            <td><?php echo $value->email ?></td>
                                            <td><?php echo $value->phone ?></td>
                                            <td><?php echo $value->level ?></td>
                                            <td>
                                                <span class="float-right">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle ml-2" type="button" id="<?php echo ('actionMenuButton' . $counter) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo (lang("Tooltips.Options", [], $Page->locale)) ?>">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="<?php echo ('actionMenuButton' . $counter) ?>">
                                                            <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/read/' . urlencode(base64_encode($value->username))) ?>" title="<?php echo (lang("Tooltips.Read", [], $Page->locale)) ?>">
                                                                <i class="fa fa-eye fa-lg"></i>&nbsp;
                                                                <?php echo (lang("Button.Show", [], $Page->locale)) ?>
                                                            </a>
                                                            <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/update/' . urlencode(base64_encode($value->username))) ?>" title="<?php echo (lang("Tooltips.Update", [], $Page->locale)) ?>">
                                                                <i class="fa fa-edit fa-lg"></i>&nbsp;
                                                                <?php echo (lang("Button.UpdateData", [], $Page->locale)) ?>
                                                            </a>
                                                            <a class="dropdown-item" href="<?php echo base_url($Page->parent . '/delete/' . urlencode(base64_encode($value->username))) ?>" onclick="javascript: return confirm('<?php echo (lang('Promp.Delete', [], $Page->locale)) ?>')" title="<?php echo (lang("Tooltips.Delete", [], $Page->locale)) ?>">
                                                                <i class="fa fa-trash fa-lg"></i>&nbsp;
                                                                <?php echo (lang("Button.Delete", [], $Page->locale)) ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-sm btn-outline-warning ml-2 mt-2 mb-2" title="<?php echo lang("Tooltips.DeleteSelected", [], $Page->locale) ?>" onclick="return confirm('<?php echo lang('Promp.DeleteSelected', [], $Page->locale) ?>')">
                                <i class="fa fa-minus-square"></i>&nbsp;<?php echo lang("Button.DeleteSelected", [], $Page->locale) ?>
                            </button>
                            <a href="<?php echo site_url($Page->parent . '/truncate') ?>" class="btn btn-sm btn-outline-danger ml-2 mt-2 mb-2" onclick="return confirm('<?php echo lang('Promp.Truncate', [], $Page->locale) ?>')">
                                <i class="fa fa-trash"></i>&nbsp;<?php echo lang("Button.Truncate", [], $Page->locale) ?>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <!-- pagination -->
                        <?php echo $pager->makeLinks($currentPage, $perPage, $totalrecord, 'custom_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>;