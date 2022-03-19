<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Maps
 */
class Maps extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //CheckLogin
        if (!$this->session->logedUser) {
            redirect(base_url() . 'login', 'refresh');
        }
        $this->load->model('Maps_model');
    }

    public function index()
    {
        $data['headerTitle'] = "SMART COMMAND CENTER";
        $data['categorys']   = $this->getCategorys();
        $this->load->view('maps.php', $data);
    }

    public function cctvs()
    {
        $identifier = $this->input->get('identifier');
        $categoryId = $this->Maps_model->getSubCategoryId($identifier);
        if (!empty($categoryId)) {
            $cctvs = $this->Maps_model->getCctvs($categoryId->id);
            $this->outputJson(200, $cctvs);
        } else {
            $this->outputJson(204, array('run' => 'error', 'msg' => 'no record for ' . $identifier . '.'));
        }
    }

    public function cases()
    {
        $cases = $this->Maps_model->getCases();
        $this->outputJson(200, $cases);
    }

    public function casesfrom()
    {
        $categoryId = $this->input->get('category_id');
        $cases      = $this->Maps_model->getCaseByCategory($categoryId);
        $this->outputJson(200, $cases);
    }

    public function getAnggota()
    {
        $cases = $this->Maps_model->getMapAnggota();
        $this->outputJson(200, $cases);
    }
    public function getMobilPjr()
    {
        $cases = $this->Maps_model->getMapMobilPJR();
        $this->outputJson(200, $cases);
    }
    public function getMotorPjr()
    {
        $cases = $this->Maps_model->getMapMotorPJR();
        $this->outputJson(200, $cases);
    }

    public function markers()
    {
        $markers    = $this->Maps_model->getMarkers();
        $allMarkers = array();
        for ($i = 0; $i < count($markers); $i++) {
            $allMarkers[$markers[$i]['identifier']] = array();
        }
        $this->outputJson(200, $allMarkers);
    }

    public function categorys()
    {
        $categorys = $this->getCategorys();
        $this->outputJson(200, $categorys);
    }

    public function iconcategory()
    {
        $categoryIdentifier = $this->input->get('identifier');
        $categoryIcon       = $this->Maps_model->getCategoryIcon($categoryIdentifier);
        if (!empty($categoryIcon)) {
            $this->outputJson(200, $categoryIcon);
        } else {
            $this->outputJson(204, array('run' => 'error', 'msg' => 'no record for ' . $identifier . '.'));
        }
    }

    private function getCategorys()
    {
        $categorys = $this->Maps_model->getCategory();
        for ($i = 0; $i < count($categorys); $i++) {
            $categorys[$i]['sub_category'] =
            $this->Maps_model->getSubCategory($categorys[$i]['id']);
        }
        return $categorys;
    }

    public function outputJson($headerStatus, $data)
    {
        $this->output
            ->set_status_header($headerStatus)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    // PEMDA //
    public function pemda()
    {
        $this->load->view('pemda');
    }

    public function getcctvpemda()
    {
        $sql = "SELECT cctv_id, site_name, url, lat, lng, availability, checked FROM map_cctv_bali_tower WHERE availability = 1 AND added_to_map = 0";
        $q   = $this->db->query($sql)->result_array();
        $this->outputJson(200, $q);
    }

    public function addtocctv()
    {
        $cctvId = $this->input->get('id');
        $sql    = "SELECT site_name, url, lat, lng FROM map_cctv_bali_tower WHERE cctv_id = $cctvId";
        $q      = $this->db->query($sql);
        $r      = $q->first_row();
        if (!empty($r)) {
            $sql2 = "INSERT INTO map_cctv (cctv_name, url, url_type, lat, lng, owner, category_sub_id, availability) VALUES ('$r->site_name', '$r->url', 'html', '$r->lat', '$r->lng', 'balitower', 2, 1)";
            $q2   = $this->db->query($sql2);
            if ($q2) {
                $sql3 = "UPDATE map_cctv_bali_tower SET added_to_map = 1 WHERE cctv_id = $cctvId";
                $q3   = $this->db->query($sql3);
                if ($q3) {
                    echo 'success';
                } else {echo 'error';}
            }
        }
    }
    public function listwarning()
    {
        $data['headerTitle'] = "Smart Traffic Command Centre";
        // $data['headerTitle'] = "";
        $data['cctvWarning'] = $this->Maps_model->checkWarning();
        $this->load->view('list', $data);
    }

}
