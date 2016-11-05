<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">景点管理<small> 景点列表</small></h3>
            <?php echo breadcrumb(array('景点管理', '景点产品', '景点列表')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('scenic_base/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">景点搜索</label>
                                    <div class="controls">
                                        <input type="text" name="scenic_search" value="<?php echo $this->input->get('scenic_search') ?>" class="m-wrap span12" placeholder="请输入景区编号或景区名称">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">景点星级</label>
                                    <div class="controls">
                                        <select name="star_level" class="m-wrap span12">
                                            <option value="0">全部</option>
                                            <?php foreach ($starLevel as $key=>$value):?>
                                                <option value="<?php echo $key?>" <?php if($key == $this->input->get('star_level')):?>selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">景点状态</label>
                                    <div class="controls">
                                        <select name="staus" class="m-wrap span12">
                                            <option value="0">全部</option>
                                            <?php foreach ($updown as $k=>$v):?>
                                                <option value="<?php echo $k ?>" <?php if($k == $this->input->get('updown')):?>selected="selected"<?php endif;?>><?php echo $v;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">供 应 商</label>
                                    <div class="controls">
                                        <input type="text" name="supplier_id" value="<?php echo $this->input->get('supplier_id') ?>" class="m-wrap span12" placeholder="请输入供应商编号">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">添加时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="start_date" size="16" value="<?php echo $this->input->get('start_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_date" size="16" value="<?php echo $this->input->get('end_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">省/市/区</label>
                                    <div class="controls">
                                        <?php $this->load->view('commonhtml/districtSelect');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn green">搜索</button>
                            <button type="button" class="btn reset_button_search">重置条件</button>
                            <button type="submit" name="excel" class="btn">导出Excel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>列表</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <div class="clearfix">
                            <a href="<?php echo base_url('scenic_base/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="2%"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th width="5%">编号</th>
                                        <th width="15%">景点名称</th>
                                        <th width="8%">景点主题</th>
                                        <th width="8%">景点星级</th>
                                        <th width="16%">景点地址</th>
                                        <th width="15%">开放时间</th>
                                        <th width="6%">供应商</th>
                                        <th>状态</th>
                                        <th width="12%">添加时间</th>
                                        <th width="15%">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->sid;?></td>
                                        <td><?php echo $item->scenic_name;?></td>
                                        <td><?php echo $item->theme_id;?></td>
                                        <td><?php echo $starLevel[$item->star_level];?></td>
                                        <td><?php echo $item->address;?></td>
                                        <td><?php echo $item->open_time;?></td>
                                        <td><?php echo $item->supplier_id;?></td>
                                        <td>
                                            <a href="javascript:;" class="modify-updown glyphicons no-js <?php if ($item->updown == 1):?>ok_2<?php else :?>remove_2<?php endif;?>" data-goods-id="<?php echo $item->sid;?>" data-flag="<?php echo $item->updown ?>">
                                                <i></i>
                                            </a>
                                        </td>
                                        <td><?php echo $item->created_at;?></td>
                                        <td>
                                            <p>
                                                <a href="<?php echo base_url('scenic_goods/grid').'?sid='.$this->input->get('sid') ?>" class="btn mini green">门票</a>
                                                <a href="<?php echo base_url('scenic_base/images/'.$item->sid);?>" class="btn mini green">图片</a>
                                            <p>
                                            <p>
                                                <a href="<?php echo base_url('scenic_base/edit/'.$item->sid) ?>" class="btn mini green">编辑</a>
                                                <a href="<?php echo base_url('scenic_base/copy/'.$item->sid);?>" class="btn mini green">复制</a>
                                            </p>
                                            <p><a href="<?php echo base_url('scenic_base/edit/'.$item->sid) ?>" class="btn mini green">预览</a></p>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php $this->load->view('layout/pagination');?>
                        <?php else: ?>
                            <div class="alert"><p>未找到数据。<p></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<script type="text/javascript">
    $(function(){
        $('.modify-updown').click(function(){
            var status = '下架';
            if ($(this).hasClass('remove_2')) {
                status = '上架';
            }
            if (confirm('确定要'+status+'?')) {
                var obj = $(this);
                var goods_id = $(this).attr('data-goods-id');
                var flag = $(this).attr('data-flag');
                $.ajax({
                    url:hostUrl()+'/scenic_base/setUpdown',
                    type:'POST',
                    dataType:'json',
                    data: {goods_id:goods_id,flag:flag},
                    success: function(data) {
                        if (data.flag == 2) {
                            obj.attr('data-flag', data.flag).addClass('remove_2').removeClass('ok_2');
                        } else if(data.flag == 1) {
                            obj.attr('data-flag', data.flag).addClass('ok_2').removeClass('remove_2');
                        } else {
                            alert('操作失败');
                        }
                    }
                });
            }
        });
    });
</script>
