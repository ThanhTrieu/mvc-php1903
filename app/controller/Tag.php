<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}
// nap Controller base
use App\Controller\Controller;
use App\Model\Tag_model;

class Tag extends Controller
{
	private $tagModel;
	public function __construct()
	{
		$this->tagModel = new Tag_model();
	}

	public function index()
	{
		$data = [];
		//load header
		$header = [];
		$header['title'] = 'This is Tags';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		// truyen ca mang $data ra ngoai view
		$this->loadView('tag/index_view', $data);
		// load footer
		$this->loadFooter();
	}

	public function add()
	{
		//load header
		$header = [];
		$header['title'] = 'This is add Tags';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		// truyen ca mang $data ra ngoai view
		$this->loadView('tag/add_view');
		// load footer
		$this->loadFooter();
	}

	public function handleAdd()
	{
		if(isset($_POST['btnAdd'])){

			$nameTag = $_POST['nameTag'] ?? '';
			$nameTag  = strip_tags($nameTag);

			$descTag = $_POST['descTag'] ?? '';

			// validate data
			$errros = validateDataAddTags($nameTag);
			$chkFlag = true;
			foreach ($errros as $key => $err) {
				if(!empty($err)){
					$chkFlag = false;
					break;
				}
			}

			if($chkFlag){
				// nhap dung du lieu
				// xoa bo di session loi
				if(isset($_SESSION['errAddTags'])){
					unset($_SESSION['errAddTags']);
				}
				// add du lieu vao db
				// kiem tra xem name tag da ton tai trong db chua?
				// neu chua ton tai thi them moi nguoc lai bao loi
				$chkAdd = $this->tagModel->checkExitsNameTag($nameTag);
				if($chkAdd ){
					// da ton tai - khong them moi
					header("Location:?c=tag&m=add&state=exist");
				} else {
					// them moi
					$add = $this->tagModel->addDataTag($nameTag, $descTag);
					if($add){
						header("Location:?c=tag&m=index");
					} else {
						header("Location:?c=tag&m=add&state=errAdd");
					}
				}
			} else {
				// nhap sai du lieu
				$_SESSION['errAddTags'] = $errros;
				// quay lai dung form add
				header("Location:?c=tag&m=add&state=err");
			}
		}
	}
}











