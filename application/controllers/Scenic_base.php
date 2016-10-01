<?php
class Scenic_base extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('scenic_base_model', 'scenic_base');
        $this->load->model('scenic_theme_model', 'scenic_theme');
        $this->load->model('supplier_model', 'supplier');
        $this->load->model('user_model', 'user');
    }

    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg - 1) * $page_num;
        $config['first_url'] = base_url('scenic_base/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('scenic_base/grid');
        $config['total_rows'] = $this->scenic_base->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->scenic_base->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['scope'] = array(1 => '自营劵', 2 => '店铺劵');
        $data['status'] = array(1 => '未使用', 2 => '已使用');
        $this->load->view('scenic_base/grid', $data);
    }
}