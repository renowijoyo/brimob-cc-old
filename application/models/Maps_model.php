<?php
/**
 * Class Maps Model
 */
class Maps_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getMapData($categoryId){
        $sql = "SELECT * FROM map_category_data mcd
                LEFT JOIN map_category_sub mcs ON mcs.id = mcd.category_id
                WHERE mcs.identifier = ? and status = 1";
        $q = $this->db->query($sql,array($categoryId));
        if ($q->num_rows()>0) {
            return $q->result_array();
        } else {
            $sqla = "SELECT channel_name,url AS video_url, lat AS latitude,lng AS longitude,'calm' AS map_status,map_icon FROM map_cctv mcd
                LEFT JOIN map_category_sub mcs ON mcs.id = mcd.category_sub_id
                WHERE mcs.identifier = ? AND mcd.availability = 1";
            $qa = $this->db->query($sqla,array($categoryId));
            return $qa->result_array();
        }
        
    }
    public function getCctvs($categoryId)
    {
        $sql = "SELECT
      map_cctv.id, map_cctv.cctv_name, map_cctv.lat,
      map_cctv.lng, map_cctv.url, map_cctv.url_type,
      map_category_sub.icon
    FROM map_cctv
    LEFT JOIN map_category_sub ON map_cctv.category_sub_id = map_category_sub.id
    WHERE map_cctv.category_sub_id = '$categoryId'
    LIMIT 100";
        $q = $this->db->query($sql);
        return $q->result_array();
    }

    public function getSubCategoryId($identifier)
    {
        $sql = "SELECT id FROM map_category_sub WHERE identifier = '$identifier'";
        $q   = $this->db->query($sql);
        return $q->first_row();
    }

    public function getCategoryIcon($identifier)
    {
        $sql = "SELECT icon FROM map_category_sub WHERE identifier = '$identifier'";
        $q   = $this->db->query($sql);
        return $q->first_row();
    }

    public function getCases()
    {
        $sql = "SELECT
              work_order_mobile.idworkordermobile,
              work_order_mobile.lat,
              work_order_mobile.lng,
              work_order_mobile.pengaduan,
              subkategori.sub_kategori
            FROM work_order_mobile
            LEFT JOIN subkategori ON work_order_mobile.sub_kategori_id = subkategori.idsubkategori
            ";
        $q = $this->db->query($sql);
        return $q->result_array();
    }

    public function getCaseByCategory($categoryId)
    {
        $db2 = $this->load->database('ntmcdb', TRUE);
        $sql = "SELECT
              work_order_mobile.idworkordermobile,
              work_order_mobile.lat,
              work_order_mobile.lng,
              work_order_mobile.pengaduan,
              subkategori.sub_kategori
            FROM work_order_mobile
            LEFT JOIN subkategori ON work_order_mobile.sub_kategori_id = subkategori.idsubkategori
            WHERE subkategori.idsubkategori = $categoryId";
        $q = $db2->query($sql);
        return $q->result_array();
    }

    public function getMarkers()
    {
        $sql = "SELECT identifier FROM map_category_sub WHERE marker = 1";
        $q   = $this->db->query($sql);
        return $q->result_array();
    }

    public function getCategory()
    {
        $sql = "SELECT * FROM map_category WHERE active = 1 ORDER BY urutan ASC";
        $q   = $this->db->query($sql);
        return $q->result_array();
    }

    public function getSubCategory($categoryId)
    {
        $sql = "SELECT name, identifier, icon FROM map_category_sub WHERE active = 1 AND category_id = $categoryId ORDER BY urutan ASC";
        $q   = $this->db->query($sql);
        return $q->result_array();
    }
    public function getMapAnggota()
    {
        $sql = "SELECT * FROM map_anggota
        LEFT JOIN map_category_sub ON map_anggota.category_sub_id = map_category_sub.id
        WHERE availability = 1";
        $q = $this->db->query($sql);
        return $q->result_array();
    }
    public function getMapMobilPJR()
    {
        $sql = "SELECT * FROM map_mobil_pjr
        LEFT JOIN map_category_sub ON map_mobil_pjr.category_sub_id = map_category_sub.id
        WHERE availability = 1";
        $q = $this->db->query($sql);
        return $q->result_array();
    }
    public function getMapMotorPJR()
    {
        $sql = "SELECT * FROM map_motor_pjr
        LEFT JOIN map_category_sub ON map_motor_pjr.category_sub_id = map_category_sub.id
        WHERE availability = 1";
        $q = $this->db->query($sql);
        return $q->result_array();
    }
    public function checkWarning()
    {
        $sql = "SELECT * FROM map_warning";
        $q   = $this->db->query($sql);
        return $q->result_array();
    }
    public function checkCCTVWarningExist($channel_name)
    {
        $sql = "SELECT * FROM map_warning WHERE channel_name = ?";
        $q   = $this->db->query($sql, array($channel_name));
        return $q->num_rows();
    }
    public function insertCCTVWarning($channel_name, $latitude, $longitude, $origin, $snapshot_path, $type, $time, $channel_id)
    {
        $typeCol       = array('Loitering', 'CrowdOn');
        $chanelNameUrl = str_replace(' ', '', strtolower($channel_id));
        // Inserting New Map If not Exist
        if ($type == 'CameraDisconnected') {
            $map_status = 'problem';
            $map_icon   = 'cctv_alert.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        } else if (in_array($type, $typeCol)) {
            $map_status = 'warn';
            $map_icon   = 'cctv_warn.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        } else {
            $map_status = 'calm';
            $map_icon   = 'cctv_calm.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        }

        $data = array(
            'channel_name'  => $channel_name,
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'origin'        => $origin,
            'snapshot_path' => $snapshot_path,
            'type'          => $type,
            'time'          => $time,
            'map_status'    => $map_status,
            'map_icon'      => $map_icon,
            'video_url'     => $video_url,
            'channel_id'    => $channel_id,
        );
        $this->db->insert('map_warning', $data);

    }
    public function updateCCTVWarning($channel_name, $latitude, $longitude, $origin, $snapshot_path, $type, $time, $channel_id)
    {
        $typeCol       = array('Loitering', 'CrowdOn');
        $chanelNameUrl = str_replace(' ', '', strtolower($channel_name));
        if ($type == 'CameraDisconnected') {
            $map_status = 'problem';
            $map_icon   = 'cctv_alert.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        } else if (in_array($type, $typeCol)) {
            $map_status = 'warn';
            $map_icon   = 'cctv_warn.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        } else {
            $map_status = 'calm';
            $map_icon   = 'cctv_calm.png';
            $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        }
        // Update Map CCTV
        $data = array(
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'origin'        => $origin,
            'snapshot_path' => $snapshot_path,
            'type'          => $type,
            'time'          => $time,
            'map_status'    => $map_status,
            'map_icon'      => $map_icon,
            'video_url'     => $video_url,
            'channel_id'    => $channel_id,
        );

        $this->db->where('channel_name', $channel_name);
        $this->db->update('map_warning', $data);
    }
    public function normalizeCCTV()
    {
        $data = array(
            'origin'        => '',
            'snapshot_path' => '',
            'map_status'    => 'calm',
            'map_icon'      => 'cctv_calm.png',
        );

        $this->db->update('map_warning', $data);

    }
    public function mapWebhook($webhook)
    {
        // Inserting New Map If not Exist
        $data = array(
            'webhook' => $webhook,
        );
        $this->db->insert('map_webhook', $data);
    }
    public function changeOnline($channel_name)
    {
        $map_status    = 'calm';
        $map_icon      = 'cctv_calm.png';
        $chanelNameUrl = str_replace(' ', '', strtolower($channel_name));
        $video_url     = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';

        $data = array(
            'map_status' => $map_status,
            'map_icon'   => $map_icon,
            'video_url'  => $video_url,
        );

        $this->db->where('channel_name', $channel_name);
        $this->db->update('map_warning', $data);
    }
    public function changeOffline($channel_name)
    {
        $map_status = 'problem';
        $map_icon   = 'cctv_alert.png';
        $video_url  = 'http://118.91.132.134:8080/' . $chanelNameUrl . '/embed.html?realtime=true';
        $data       = array(
            'map_status' => $map_status,
            'map_icon'   => $map_icon,
            'video_url'  => $video_url,
        );

        $this->db->where('channel_name', $channel_name);
        $this->db->update('map_warning', $data);
    }
    public function countingDataTripwire($channel_name, $counting_date)
    {
        $sql         = "SELECT * FROM map_warning_counting WHERE channel_name = ? AND counting_date = ?";
        $query       = $this->db->query($sql, array($channel_name, $counting_date));
        $resultArray = $query->result_array();
        if ($query->num_rows() < 1) {
            $data = array(
                'channel_name'  => $channel_name,
                'counting_date' => $counting_date,
                'count'         => 1,
            );
            $this->db->insert('map_warning_counting', $data);
        } else {
            $lastNumber = $resultArray[0]['count'];
            $data       = array(
                'count' => $lastNumber + 1,
            );

            $this->db->where('channel_name', $channel_name);
            $this->db->where('counting_date', $counting_date);
            $this->db->update('map_warning_counting', $data);
        }
    }
    public function checkCCTVDetail($channel_name)
    {
        $sql = "SELECT * FROM map_warning WHERE channel_name = ?";
        $q   = $this->db->query($sql, array($channel_name));
        return $q->result_array();
    }
    public function showcounting()
    {
        $sqlDetail = "SELECT * FROM map_warning_counting";
        $query     = $this->db->query($sqlDetail)->result_array();
        for ($i = 0; $i < count($query); $i++) {
            $categories[]       = $query[$i]['counting_date'];
            $data['categories'] = array_values(array_unique($categories));

            $channel_name     = $query[$i]['channel_name'];
            $count[]          = $query[$i]['count'];
            $data['series'][] = array(
                'name' => $channel_name,
                'data' => $count,
            );
        }

        return $data;
    }
    function detailLiveStreaming($channel_name){
        $sql = "SELECT channel_name,url AS video_url, lat AS latitude,lng AS longitude,'calm' AS map_status FROM map_cctv WHERE channel_name = ?";
        $q   = $this->db->query($sql, array($channel_name));
        if ($q->num_rows() >0 ) {
            return $q->result_array();
        } else {
            $sqlGetCategoryData = "SELECT channel_name,video_url,latitude,longitude,'calm' AS map_status FROM map_category_data WHERE channel_name = ?";
            $qCatData   = $this->db->query($sqlGetCategoryData, array($channel_name));
            return $qCatData->result_array();
        }
    }
}
