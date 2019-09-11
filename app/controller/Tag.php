<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}
// nap Controller base
use App\Controller\Controller;
use App\Model\Tag_model;
use App\Libs\Panigation;

class Tag extends Controller
{
	private $tagModel;
	private $_numItem = 2;

	public function __construct()
	{
		$this->tagModel = new Tag_model();
	}

	public function index()
	{
		$data = [];
		$keyword = $_GET['keyword'] ?? '';
		$keyword = strip_tags($keyword);
		$data['keyword'] = $keyword;

		//page
		$page = $_GET['page'] ?? '';
		$page = is_numeric($page) && $page > 0 ? $page : 1;

		$params = [
			'c' => 'tag',
			'm' => 'index',
			'page' => '{page}', // sau nay thay the du lieu
			'keyword' => $keyword
		];

		$linkPage = Panigation::createLink($params);
		$listTags = $this->tagModel->getAllDataTags($keyword);
		$totalRecord = count($listTags);

		// test panigate
		$panigate = Panigation::panigate($linkPage, $page, $totalRecord, $this->_numItem, $keyword);

		$listTagsByPage = $this->tagModel->getDataTagsByPage($panigate['start'],$this->_numItem, $keyword);
		$data['listTags'] = $listTagsByPage;
		$data['panigate'] = $panigate['htmlPage'];

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
		$data = [];
		// thong bao loi khong nhap du lieu
		$state = $_GET['state'] ?? '';
		if($state === 'err'){
			$data['errAdd'] = $_SESSION['errAddTags'] ?? [];
		} else {
			$data['errAdd'] = [];
		}
		// loi trung ten tag hoac khong insert dc du lieu
		$data['message'] = $state;

		//load header
		$header = [];
		$header['title'] = 'This is add Tags';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		// truyen ca mang $data ra ngoai view
		$this->loadView('tag/add_view',$data);
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

	public function delete()
	{
		$idTag = $_POST['id'] ?? '';
		$idTag = is_numeric($idTag) ? $idTag : 0;
		$del = $this->tagModel->deleteTagById($idTag);
		if($del){
			echo "ok";
		} else {
			echo "err";
		}
	}

	public function detail()
	{
		$id = $_GET['id'] ?? '';
		$id = is_numeric($id) ? $id : 0;
		// lay thong tin chi tiet cua tag theo id
		$infoTag = $this->tagModel->getInfoDataTagById($id);
		if($infoTag){
			$data = [];
			$data['info'] = $infoTag;


			$header = [];
			$header['title'] = 'Detail of tag';
			$this->loadHeader($header);
			// nap vao 1 view tu thu muc view
			// truyen ca mang $data ra ngoai view
			$this->loadView('tag/detail_view', $data);
			// load footer
			$this->loadFooter();

		} else {
			//load header
			$header = [];
			$header['title'] = 'Not found page';
			$this->loadHeader($header);
			// nap vao 1 view tu thu muc view
			// truyen ca mang $data ra ngoai view
			$this->loadView('partials/not_found_view');
			// load footer
			$this->loadFooter();
		} 
	}

	public function handleEdit()
	{
		if(isset($_POST['btnUpdate'])){
			$idTag = $_GET['id'] ?? '';
			$idTag = is_numeric($idTag) ? $idTag : 0;

			$nameTag = $_POST['nameTag'] ?? '';
			$nameTag  = strip_tags($nameTag);

			$descTag = $_POST['descTag'] ?? '';

			$status = $_POST['status'] ?? '';
			$status = $status == 1 || $status == 0 ? $status : 0;

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
				// xoa session loi update
				if(isset($_SESSION['editErrTag'])){
					unset($_SESSION['editErrTag']);
				}
				// neu nguoi dung thay doi nam tag thi kiem tra xem name tag can thay doi do co ton tai trong db ko ? neu co ko cho update va nguoc lai cho update (LOAI TRU CHINH NAME TAG DANG CAN update)
				$chkUpdate = $this->tagModel->checkUpddateNameTag($idTag, $nameTag);
				if($chkUpdate){
					// da ton tai ko cho update
					header("Location:?c=tag&m=detail&id={$idTag}&state=exist");
				} else {
					// update data
					$up = $this->tagModel->updateDataTagById($idTag, $nameTag, $descTag, $status);
					if($up){
						header("Location:?c=tag&m=index");
					} else {
						header("Location:?c=tag&m=detail&id={$idTag}&state=fail");
					}
				}
			} else {
				$_SESSION['editErrTag'] = $errros;
				// quay lai dung form edit data
				header("Location:?c=tag&m=detail&id={$idTag}&state=err");
			}
		}
	}
}











