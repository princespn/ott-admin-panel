<?php ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Aws\S3\Exception\S3Exception;

class S3 extends CI_Model{
public $s3;	
	function __construct()
    {
		parent::__construct();
		require 'vendor/autoload.php';
	
		$this->s3 = new S3Client([
			'version' => 'latest',
			'region'  => 's-sgc1',
			'credentials'=>[
			'key'=>"6FTJU9RASX4B5YHHCJ20",
			'secret'=>"HAolnqLuw3tRpCcUhGjzEkDpLK3K0SUT0lg1ElZZ"
			//'host_base' => '',	
			]
		]);
	}
	
	public function uploadVideo($filename,$temp_file_path,$keyname){
		try{
			$result = $this->s3->putObject([
				'Bucket' => "oops1234",
				'Key'    => $keyname,
				'Body'   => fopen($temp_file_path,'r') ,
				'ContentType'=>'video/mp4',
				'ACL'    => '--public-read--'
			]);
		
			// Print the URL to the object.
			return $result['ObjectURL'] . PHP_EOL;
		} catch(S3Exception $e){
			return $e->getMessage();
		}
	}

	public function deleteVideo($keyname){
		try{
			
			$result = $this->s3->deleteObject([
				'Bucket' => 'oops1234',
				'Key'    => $keyname,
				'ContentType'=>'video/mp4',
				'ACL'    => '--public-read--'
			]);

			if ($result['DeleteMarker'])
			{
				return $result;
			} else {
				return ('Error: ' . $keyname . ' was not deleted.' . PHP_EOL);
			}	
		} catch(S3Exception $e){
			return $e->getMessage();

		}
	}

	public function uploadMovie($filename,$temp_file_path,$keyname){
		$uploader = new MultipartUploader($this->s3, fopen($temp_file_path,'r'), [
			'bucket' => 'oops1234',
			'key' => $keyname,
			'ContentType'=>'video/mp4',
			'ACL'    => '--public-read--'

		]);
		
		try {
			$result = $uploader->upload();
			if($result['ObjectURL']){
				return $result['ObjectURL'];
			} else {
				return $e->getMessage();
			}
			
		} 

		catch (S3Exception $e) {
  				// Catch an S3 specific exception.
 				 echo $e->getMessage();
		}
	}

	public function uploadImage($filename,$temp_file_path,$keyname){
		try
		{
			$result = $this->s3->putObject([
				'Bucket' => "oops1234",
				'Key'    => $keyname,
				'Body'   => fopen($temp_file_path,'r') ,
				//'ContentType'=>'image/jpeg'|| 'image/png' || 'image/jpg',
				'ACL'    => '--public-read--'
			]);
			//print_r($result['ObjectURL']); die();
		
			// Print the URL to the object.
			if($result['ObjectURL']){
				return $result['ObjectURL'];
			} else {
				return "Error While Uploading";
			}
		} catch(S3Exception $e){
			return $e->getMessage();
		}
	}
	public function uploadFile($filename,$temp_file_path,$keyname){
		try
		{ 
			$result = $this->s3->putObject([
				'Bucket' => "oops1234",
				'Key'    => $keyname,
				'Body'   => fopen($temp_file_path,'r') ,
				//'ContentType'=>'image/jpeg'|| 'image/png' || 'image/jpg',
				'ACL'    => '--public-read--'
			]);

			echo 'aaa'.$result ; die();
			
			// Print the URL to the object.
			if($result['ObjectURL']){
				return $result['ObjectURL'];
			} else {
				return "Error While Uploading";
			}
		} catch(S3Exception $e){
			return $e->getMessage();
		}
	}
}		
