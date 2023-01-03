<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;
	protected $error_message;
	protected $config;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->config = new ConfigModel();

		$this->error_message = [
			'required'  => 'Tidak boleh kosong',
			'is_unique'    => '{value} sudah tercatat',
			'min_length'    => 'Minimal berisi {param} karakter',
			'max_length'	=> 'Maksimal berisi {param} karakter',
			'max_size'	=> 'File terlalu besar. Maksimal 8 MB',
			'uploaded'	=> 'Harus melakukan upload',
			'mime_in'	=> 'Jenis file tidak tepat. File harus berupa {param}',
			'ext_in'	=>	'Ekstensi file tidak tepat. File harus berekstensi {param}',
			'is_image'	=>	'File harus berupa gambar',
			'valid_email'	=> 'Bukan merupakan format email',
			'numeric'	=> 'Hanya menerima angka',
			'matches'	=> 'Ulangi Password salah',
			'regex_match'	=> 'Format tidak sesuai yang diharapkan'
		];

		session();

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
	}

	public function image_compression($source, $destination, $image_name)
	{
		$info = getimagesize($source);
		$quality = 50;

		if ($info['mime'] == 'image/jpeg') {
			$image = imagecreatefromjpeg($source);
			imagejpeg($image, $destination . "/$image_name", $quality);
		} elseif ($info['mime'] == 'image/png') {
			$image = imagecreatefrompng($source);

			imagealphablending($image, true);
			imagesavealpha($image, true);

			$pngQuality = ($quality - 100) / 11.111111;
			$pngQuality = round(abs($pngQuality));

			imagepng($image, $destination . "/$image_name", $pngQuality);
		}
	}
}
