<?php
// dinh nghia cac ham tien ich de su dung o bat ky dau trong ung dung
function validateDataAddTags($nameTag)
{
	$errros = [];
	$errros['nameTag'] = (empty($nameTag) || strlen($nameTag) > 150) ? 'Name tag khong duoc trong va nho hon 15o ki tu' : '';
	return $errros;
}