<?php
defined('BASEPATH') or exit('No direct script access allowed');
//resize image define
define('WIDTH',  640);
define('HEIGHT', 480);
define('dpi', 160);
class ScanQR extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') == null && $this->session->userdata('logged_in') == false) {
			redirect(base_url(), 'refresh');
		};
	}

	public function index()
	{
		$this->load->view('template/header_view');
		$this->load->view('scanQR_view');
		$this->load->view('template/footer_view');
	}

	public function takephoto($carid_id = NULL, $size_small = null)
	{
		$data_page = array(
			'carid_id' => $carid_id,
			'size_small' => $size_small
		);
		$this->load->view('template/header_view');
		$this->load->view('takephoto_view', $data_page);
		$this->load->view('template/footer_view');
	}

	public function add_image_manual()
	{
		error_reporting(E_ERROR | E_PARSE);
		$target_path_large = 'D:\Images\large';
		$target_path_small = 'D:\Images\small';
		$option_resize = $this->input->post('option_resize');
		$data_path = date("dmY");
		$temp_id = $this->input->post('path_image');
		$get_all_file_in_Path = $target_path_large . '\\' . $data_path . '\\' . $temp_id;
		$files_name = array_diff(scandir($get_all_file_in_Path, 1), array('..', '.'));
		$value = str_pad((sizeof($files_name) + 1), 2, "0", STR_PAD_LEFT);
		$outputfilename = $temp_id . '_' . $value;

		$image = '';
		if (isset($_FILES['file']['name'])) {
			$image_name = $_FILES['file']['name'];
			$valid_extensions = array("jpg", "jpeg", "png");
			$extension = pathinfo($image_name, PATHINFO_EXTENSION);
			if (in_array($extension, $valid_extensions)) {
				$upload_path = $target_path_large . '\\' . $data_path . '\\' . $temp_id . '\\' . $outputfilename . '.' . $extension;
				if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
					// $message = 'Image Uploaded';
					// $image = $upload_path;
					sleep(0.2);
					if ($option_resize) {
						$output = str_replace('.jpg', '_640x480.jpg', $outputfilename . '.' . $extension);
						$img = new Imagick();
						$img->readImage($target_path_large . "\\" . $data_path . "\\" . $temp_id . "\\" . $outputfilename . '.' . $extension);
						$img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
						$img->adaptiveResizeImage(WIDTH, HEIGHT);
						$img->setImageResolution(dpi, dpi);
						$img->setImageFormat("jpg");
						$img->writeImage($target_path_small . "\\" . $data_path . "\\" . $temp_id . '\\' . $output);
					}
				} else {
					$message = 'There is an error while uploading image';
				}
			} else {
				$message = 'Only .jpg, .jpeg and .png Image allowed to upload';
			}
		} else {
			$message = 'Select Image';
		}
		$output = array(
			'message'  => $message,
			'image'   => $image
		);

		echo json_encode(['messages' => true]);
	}

	public function process_image()
	{
		try {
			error_reporting(E_ERROR | E_PARSE);
			// $rootPath = $_SERVER['DOCUMENT_ROOT'];

			$option_resize = $this->input->post('option_resize');
			$temp_id = $this->input->post('qr_id');
			$source_path = 'C:\test_franchise\bin\01SFXinput';
			$target_path_small = 'D:\Images\small';
			$target_path_large = 'D:\Images\large';
			$data_path = date("dmY");
			$files_name = [];
			while (sizeof($files_name) <= 7) {
				sleep(0.2);
				$files_name = array_diff(scandir($source_path, 1), array('..', '.'));
			}
			sleep(0.2);
			if (!is_dir($target_path_large . "\\" . $data_path)) {
				mkdir($target_path_large . "\\" . $data_path);
			}

			if (!is_dir($target_path_large . "\\" . $data_path . "\\" . $temp_id)) {
				mkdir($target_path_large . "\\" . $data_path . "\\" . $temp_id);
			}

			for ($i = 0; $i < sizeof($files_name); $i++) {
				sleep(0.2);
				rename($source_path . "\\" . $files_name[$i], $target_path_large . "\\" . $data_path . "\\" . $temp_id . "\\" . $temp_id . '_' . $files_name[$i]);
				if ($option_resize) {
					if (!is_dir($target_path_small . "\\" . $data_path)) {
						mkdir($target_path_small . "\\" . $data_path);
						sleep(0.2);
					}

					if (!is_dir($target_path_small . "\\" . $data_path . "\\" . $temp_id)) {
						mkdir($target_path_small . "\\" . $data_path . "\\" . $temp_id);
						sleep(0.2);
					}

					$output = str_replace('.jpg', '_640x480.jpg', $temp_id . '_' . $files_name[$i]);
					//ffmpeg
					// $file_str = $rootPath.'/ffmpeg.exe -i '.$target_path_large."\\".$data_path."\\".$temp_id."\\".$temp_id.'_'.$files_name[$i].' -vf scale=640:480 -dpi 160 '. $target_path_small ."\\".$data_path."\\".$temp_id. '\\' .$output;
					// shell_exec($file_str);

					$img = new Imagick();
					$img->readImage($target_path_large . "\\" . $data_path . "\\" . $temp_id . "\\" . $temp_id . '_' . $files_name[$i]);
					$img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
					$img->adaptiveResizeImage(WIDTH, HEIGHT);
					$img->setImageResolution(dpi, dpi);
					$img->setImageFormat("jpg");
					$img->writeImage($target_path_small . "\\" . $data_path . "\\" . $temp_id . '\\' . $output);
				}
			}
			$this->logs_temp($temp_id);
			echo json_encode(['messages' => true]);
		} catch (\Throwable $th) {
			echo json_encode(['messages' => false]);
		}
	}

	public function get_all_filename()
	{
		error_reporting(E_ERROR | E_PARSE);
		try {
			$qr_id = $this->input->post('qr_id');
			$data_path = date("dmY");
			$target_path_large = 'D:\Images\large';
			$files_name = array_diff(scandir($target_path_large . '\\' . $data_path . '\\' . $qr_id, 1), array('..', '.'));
			echo json_encode(['messages' => $files_name]);
		} catch (\Throwable $th) {
			echo json_encode(['messages' => 'error']);
		}
	}

	public function showImage_on_display($path_id = NULL, $imagename = null)
	{
		error_reporting(E_ERROR | E_PARSE);
		$data_path = date("dmY");
		$target_path_large = 'D:\Images\large';
		$filename = $target_path_large . '\\' . $data_path . '\\' . $path_id . '\\' . $imagename;
		$handle = fopen($filename, "rb");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		header("content-type: image/jpg");
		echo $contents;
	}

	public function take_a_photo_udp()
	{
		try {
			$server = '127.0.0.1';
			$port = 16000;
			$msg = 'P';
			$len = strlen($msg);
			$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
			socket_sendto($sock, $msg, $len, 0, $server, $port);
			socket_close($sock);
			sleep(1);
			echo json_encode(['mesagess' => true]);
		} catch (\Throwable $th) {
			echo json_encode(['mesagess' => false]);
		}
	}

	public function Success()
	{
		$this->load->view('template/header_view');
		$this->load->view('Success_view');
		$this->load->view('template/footer_view');
	}

	private function logs_temp($qr_id_log)
	{
		$data_path = date("dmY");
		$target_path_temp_logs = 'D:\Images\logs\temp';
		$filename = $target_path_temp_logs.'\\'.$data_path.'_tmp.csv';
		if (!is_file($filename)){
			$file = fopen($filename,"w");
			fclose($file);
		}
		// The nested array to hold all the arrays
		$the_big_array = [];
		
		// Open the file for reading
		if (($h = fopen("{$filename}", "r")) !== FALSE) {
			// Each line in the file is converted into an individual array that we call $data
			// The items of the array are comma separated
			while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
				// Each individual array is being pushed into the nested array
				$the_big_array[] = $data;
			}
			// Close the file
			fclose($h);
		}

		// echo "<pre>";
		// print_r($the_big_array);
		// echo "</pre>";

		// $this->unique_imat($the_big_array);
		// array_push($the_big_array, array('3','000000000001363073', 'time', 'admin'));
		// $this->log_file_csv($the_big_array);
		// echo sizeof($the_big_array);

		if (($l = fopen("{$filename}", "a")) !== FALSE) {
			$line = array(
				array((sizeof($the_big_array) + 1), $qr_id_log, date("d-m-Y H:i:s"), $this->session->userdata('username'))
			);
			foreach ($line as $fields) {
				fputcsv($l, $fields);
			}
			fclose($l);
		}
		$this->log_file_csv();
		// // Display the code in a readable format
		// echo "<pre>";
		// array_push($the_big_array, array('3','000000000001363073', 'time', 'admin'));
		// print_r($the_big_array);
		// echo "</pre>";
	}

	private function log_file_csv()
	{
		$target_path_large = 'D:\Images\large';
		$target_path_temp_logs = 'D:\Images\logs\temp';
		$target_path = 'D:\Images';
		$data_path = date("dmY");
		$filename = $target_path_temp_logs.'\\'.$data_path.'_tmp.csv';
		$the_big_array = [];
		// Open the file for reading
		if (($h = fopen("{$filename}", "r")) !== FALSE) {
			// Each line in the file is converted into an individual array that we call $data
			// The items of the array are comma separated
			while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
				// Each individual array is being pushed into the nested array
				$the_big_array[] = $data;
			}
			// Close the file
			fclose($h);
		}

		$data_qrID = [];
		for ($i=0; $i < sizeof($the_big_array); $i++) { 
			array_push($data_qrID, $the_big_array[$i][1]);
		}
		$couting_qrID = sizeof(array_unique($data_qrID));

		$data_date_time = date("d-m-Y H:i:s");
		$header_csv = array(
			array('Last', $data_date_time),
			array('Total',  sizeof($the_big_array)),
			array('Total-IMAT', $couting_qrID),
			array('#', 'ID', 'DateTime', 'By User')
		);

		$fp = fopen($target_path . '\\logs\\' . $data_path . '.csv', 'w');
		foreach ($header_csv as $fields) {
			fputcsv($fp, $fields);
		}
		fclose($fp);

		if (($l = fopen($target_path . '\\logs\\' . $data_path . '.csv', "a")) !== FALSE) {
			foreach ($the_big_array as $fields) {
				fputcsv($l, $fields);
			}
			fclose($l);
		}
	}
}
