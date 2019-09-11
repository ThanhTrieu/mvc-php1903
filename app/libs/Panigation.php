<?php
namespace App\Libs;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

class Panigation 
{
	public static function createLink($data = [])
	{
		// muc dich tao ra duong link phan trang bo tro cho panigate
		// index.php?c=tag&m=index&page=1&keyword=abc
		// cau truc cua mang tham so $data
		/*
			$data = [
				'c' => 'tag',
				'm' => 'index',
				'page' => '{page}',
				'keyword' => abc
			]
		 */
		$strLink = '';
		foreach ($data as $key => $val) {
			$strLink .= (empty($strLink)) ? "?{$key}={$val}" : "&{$key}={$val}";
		}
		return "index.php".$strLink;
	}

	public static function panigate($link, $currentPage, $totalRecord, $rows, $keyword = '')
	{
		// di tinh total page
		$totalPage = ceil($totalRecord/$rows);

		// xac dinh gioi han cua current page
		if($currentPage < 1){
			$currentPage = 1;
		} elseif($currentPage > $totalPage){
			$currentPage = $totalPage;
		}

		// tinh start
		$start = ($currentPage - 1) * $rows;

		// tao template phan trang bang thu vien css bootstrap
		$html = '';
		$html .= '<nav>';
		$html .= '<ul class="pagination">';
		// button previous (back page - quay ve trang truoc )
		if($currentPage > 1 && $currentPage <= $totalPage){
			// xuat hien nut back page
			$html .= '<li class="page-item"><a class="page-link" href="'.str_replace('{page}', $currentPage -1, $link).'">Previous</a></li>';
		}
		// nhung trang o giua
		for($i = 1; $i <= $totalPage; $i++){
			// current page
			if($i == $currentPage){
				$html .= '<li class="page-item active"><a class="page-link">'.$currentPage.'</a></li>';
			} else {
				// nhung trang con lai
				$html .= '<li class="page-item"><a class="page-link" href="'.str_replace('{page}', $i, $link).'">'.$i.'</a></li>';
			}
		}

		// button next page
		if($currentPage >= 1 && $currentPage < $totalPage){
			$html .= '<li class="page-item"><a class="page-link" href="'.str_replace('{page}', $currentPage+1, $link).'">Next</a></li>';
		}
		$html .= '</ul>';
		$html .= '</nav>';

		// tra du lieu ve
		return [
			'start' => $start,
			'rows' => $rows,
			'keyword' => $keyword,
			'htmlPage' => $html,
			'totalPage' => $totalPage
		];
	}

}




