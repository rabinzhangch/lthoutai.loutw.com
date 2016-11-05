<?php
class Scenic_theme_model extends CI_Model
{
    private $table = 'scenic_theme';

    public function find($isArray=false)
    {
        $result = $this->db->get($this->table);
        if ($isArray) {
            $rows = array();
            foreach ($result->result_array() as $row) {
                $rows[$row['theme_id']] = $row;
            }
            return $rows;
        }
        return $result;
    }

    public function findById($theme_id)
    {
        $this->db->where('theme_id', $theme_id);
        return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->checkWhereParam($params);
        return $this->db->count_all_results($this->table);
    }   

    public function page_list($page_num, $num, $params=array())
    {
        $this->checkWhereParam($params);
        $this->db->order_by('sid', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }

    private function checkWhereParam($params = array())
    {
        if (!empty($params['sid'])) {
            $this->db->where('sid', $params['sid']);
        }
        if (!empty($params['scenic_name'])) {
            $this->db->where('scenic_name', $params['scenic_name']);
        }
        if (!empty($param['scenic_search'])) {
            $this->db->where("((`scenic_name` LIKE '%{$param['scenic_search']}%') OR (`sid`='{$param['scenic_search']}'))");
        }
        if (!empty($params['supplier_id'])) {
            $this->db->where('supplier_id', $params['supplier_id']);
        }
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=', $params['start_time'].' 00:00:00');
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=', $params['end_time'].' 23:59:59');
        }
    }

    public function insert($params=array())
    {
        $data = array(
            'scenic_name' => $params['scenic_name'],
            'special'     => $params['special'],
            'uid'         => $params['uid'],
            'star_level'  => $params['star_level'],
            'theme_id'    => $params['theme_id'],
            'open_time'   => $params['open_time'],
            'notice'      => $params['notice'],
            'info'        => $params['info'],
            'traffic'     => !empty($params['traffic']) ? $params['traffic'] : '',
            'attention'   => !empty($params['attention']) ? $params['attention'] : '',
            'supplier_id' => $params['supplier_id'],
            'province_id' => $params['province_id'],
            'city_id'     => $params['city_id'],
            'district_id' => $params['district_id'],
            'address'     => $params['address'],
            'locType'     => $params['locType'],
            'longitude'   => $params['longitude'],
            'latitude'    => $params['latitude'],
            'updown'      => $params['updown'],
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($params=array())
    {
        $data = array(
            'scenic_name' => $params['scenic_name'],
            'special'     => $params['special'],
            'uid'         => $params['uid'],
            'star_level'  => $params['star_level'],
            'theme_id'    => $params['theme_id'],
            'open_time'   => $params['open_time'],
            'notice'      => $params['notice'],
            'info'        => $params['info'],
            'traffic'     => !empty($params['traffic']) ? $params['traffic'] : '',
            'attention'   => !empty($params['attention']) ? $params['attention'] : '',
            'supplier_id' => $params['supplier_id'],
            'province_id' => $params['province_id'],
            'city_id'     => $params['city_id'],
            'district_id' => $params['district_id'],
            'address'     => $params['address'],
            'locType'     => $params['locType'],
            'longitude'   => $params['longitude'],
            'latitude'    => $params['latitude'],
            'updown'      => $params['updown'],
            'updated_at'  => date('Y-m-d H:i:s'),
        );
        $this->db->where('sid', $params['sid']);
        return $this->db->update($this->table, $data);
    }
}