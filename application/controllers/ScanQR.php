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
		$temp_id = 'IMAT' . $this->input->post('path_image');
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
						$output = str_replace('.jpg', '_640x480.jpg', $temp_id . '_' . $outputfilename . '.' . $extension);
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
			$temp_id = 'IMAT' . $this->input->post('qr_id');
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
			$files_name = array_diff(scandir($target_path_large . '\\' . $data_path . '\\IMAT' . $qr_id, 1), array('..', '.'));
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
		$filename = $target_path_large . '\\' . $data_path . '\\IMAT' . $path_id . '\\' . $imagename;
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
}
