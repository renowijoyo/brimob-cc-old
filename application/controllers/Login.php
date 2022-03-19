<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Maps_model');
    }

    public function index()
    {

        if (!$this->input->post()) {
            $this->load->view('login');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $hashed_password = $this->Login_model->getHashedPassword($username);

            if (empty($hashed_password->password)) {

                $this->load->view('login', array('loginMessage' => 'username or password not match.'));

            } else {

                $checkPassword = $this->passwordhash->CheckPassword($password, $hashed_password->password);

                if ($checkPassword) {

                    $this->session->set_userdata('logedUser', $this->Login_model->getDetail($username));

                    //DashboardGoesHere
                    redirect(base_url() . 'maps', 'refresh');

                } else {

                    $this->load->view('login', array('loginMessage' => 'username or password not match.'));

                }

            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

    public function dump()
    {
        $sql   = "SELECT * FROM map_cctv_bali_tower WHERE availability = 1 AND checked = 1";
        $cctvs = $this->db->query($sql)->result_array();
        // print_r($cctvs[1]);
        for ($i = 0; $i < count($cctvs); $i++) {
            $name         = $cctvs[$i]['site_name'];
            $url          = $cctvs[$i]['url'];
            $url_type     = "html";
            $lat          = $cctvs[$i]['lat'];
            $lng          = $cctvs[$i]['lng'];
            $owner        = "balitower";
            $category_id  = 2;
            $availability = 1;

            $sql = "INSERT INTO map_cctv VALUES('', '$name', '$url', '$url_type', '$lat', '$lng', '$owner', '$category_id', '$availability')";
            $x   = $this->db->query($sql);
            if ($x) {
                echo 'success <br/>';
            } else {
                echo 'error <br/>';
            }
        }
    }
    public function outputJson($headerStatus, $data)
    {
        $this->output
            ->set_status_header($headerStatus)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function webHook()
    {
        $json_result = file_get_contents('php://input');
        $this->Maps_model->mapWebhook($json_result);
    }
    public function getReport()
    {
        $this->Maps_model->normalizeCCTV();
        $this->load->helper('file');

        $url = 'http://118.91.132.133:48462/v1/json/events?order=desc&timeout=5';
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $extract = json_decode($response, true);
        for ($i = 0; $i < count($extract); $i++) {
            $divideNameLocation = explode("|", $extract[$i]['channel_name']);
            $channel_id         = $extract[$i]['channel_id'];
            $latitudeex         = explode(",", $divideNameLocation[1]);
            $latitude           = str_replace(' ', '', $latitudeex[0]);
            $longitude          = str_replace(' ', '', $latitudeex[1]);

            if (!empty($extract[$i]['snapshot_path'])) {
                $file_path = $this->normalizePath($extract[$i]['snapshot_path']);
                $file_path = 'http://118.91.132.133' . substr($file_path, 19);
            } else {
                $file_path = $extract[$i]['snapshot_path'];
            }

            $dump[] =
            array('channel_name' => $divideNameLocation[0],
                'latitude'           => $latitude,
                'longitude'          => $longitude,
                'origin'             => $extract[$i]['origin'],
                'snapshot_path'      => $file_path,
                'type'               => $extract[$i]['type'],
                'time'               => $extract[$i]['time'],
                'channel_id'         => $channel_id,
            );

        }

        $newArray = array();
        $sortSame = array();
        $kunci    = 0;
        foreach ($dump as $key => $line) {
            if (!in_array($line['channel_name'], $sortSame)) {
                $sortSame[]       = $line['channel_name'];
                $newArray[$kunci] = $line;
                $kunci++;
                // Check jika tidak ada di DB
                if ($this->Maps_model->checkCCTVWarningExist($line['channel_name']) == 0) {
                    // Add New Maps
                    $this->Maps_model->insertCCTVWarning(
                        $line['channel_name'],
                        $line['latitude'],
                        $line['longitude'],
                        $line['origin'],
                        $line['snapshot_path'],
                        $line['type'],
                        $line['time'],
                        $line['channel_id']);
                } else {
                    $detailCCTV = $this->Maps_model->checkCCTVDetail($line['channel_name']);
                    $timeDB     = $detailCCTV[0]['time'];
                    $timeNow    = date('Y-m-d H:i:s');
                    if ($line['type'] == 'Loitering' || $line['type'] == 'CrowdOn') {
                        $newTimeToAdd = date("Y-m-d H:i:s", strtotime($line['time'] . " +10 minutes"));
                        $this->Maps_model->updateCCTVWarning(
                            $line['channel_name'],
                            $line['latitude'],
                            $line['longitude'],
                            $line['origin'],
                            $line['snapshot_path'],
                            $line['type'],
                            $newTimeToAdd,
                            $line['channel_id']);
                    } else {
                        if ($timeNow < $timeDB) {
                            $this->Maps_model->updateCCTVWarning(
                                $line['channel_name'],
                                $line['latitude'],
                                $line['longitude'],
                                $line['origin'],
                                $line['snapshot_path'],
                                'CrowdOn',
                                $timeDB,
                                $line['channel_id']);
                        } else {
                            $this->Maps_model->updateCCTVWarning(
                                $line['channel_name'],
                                $line['latitude'],
                                $line['longitude'],
                                $line['origin'],
                                $line['snapshot_path'],
                                $line['type'],
                                $line['time'],
                                $line['channel_id']);
                        }
                    }
                }
            }
        }
        $this->outputJson(200, $newArray);
    }

    public function normalizePath($path)
    {
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('|(?<=.)/+|', '/', $path);
        if (':' === substr($path, 1, 1)) {
            $path = ucfirst($path);
        }

        return $path;
    }
    public function checkWarning()
    {
        $cctvWarning = $this->Maps_model->checkWarning();
        $this->outputJson(200, $cctvWarning);
    }
    public function getMapsData()
    {
        $category = $this->input->get('category');
        $cctvMapsData = $this->Maps_model->getMapData($category);
        $this->outputJson(200, $cctvMapsData);
    }
    public function checkwarningsse()
    {
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Connection: keep-alive");

        $cctvWarning = $this->Maps_model->checkWarning();
        echo "data:" . json_encode($cctvWarning) . "\n\n";
        print PHP_EOL;

        // ob_end_flush();
        flush();

        sleep(180);
    }
    public function online()
    {
        $alarm = $this->input->get('alarm');
        $this->Maps_model->changeOnline($alarm);
    }
    public function offline()
    {
        $alarm = $this->input->get('alarm');
        $this->Maps_model->changeOffline($alarm);
    }
    public function countingData()
    {
        $json_result  = file_get_contents('php://input');
        $jDecode      = json_decode($json_result, true);
        $channel_name = $jDecode['channel_name'];
        $realDate     = explode("T", $jDecode['event_time']);

        $divideNameLocation = explode("|", $jDecode['channel_name']);
        $channel_name       = $divideNameLocation[0];
        $counting_date      = $realDate[0];

        if ($jDecode['event_type'] == 'TripwireCrossed') {
            $this->Maps_model->countingDataTripwire($channel_name, $counting_date);
        }
    }
    public function showcounting()
    {
        $cctvDataCounting = $this->Maps_model->showcounting();
        $this->outputJson(200, $cctvDataCounting);
    }
      public function liveStream()
    {
        $getDataName = $this->uri->segment(3);
        $data['stream'] = $this->Maps_model->detailLiveStreaming($getDataName);
        $this->load->view('livestream', $data);
    }
}
