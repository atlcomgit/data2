<?php
//______________________________________________________________________________________________________________________________________________________________

namespace App;

define('ROOT', env('APP_PATH_ROOT', '/'));

class Files
{

	protected $root = "/";

	static function getFilesFromDirectory($path, $mask = '', $exclude = '')
	{
		$_RESULT = array();

		if ($path != '' && is_dir($path) && file_exists($path)) {
			if (substr($path, -1) != '/') $path .= '/';
			$files = @glob($path . $mask);
			if ($files !== false && count($files) > 0) foreach ($files as $file)
				if ($exclude == '' || !preg_match($exclude, $file)) $_RESULT[] = array('path' => dirname($file) . '/', 'file' => basename($file));
		}
		return $_RESULT;
	}

	static function createDirectory($path)
	{
		$dirpath = '';
		$path = str_replace('\\', '/', $path);
		$path = explode("/", $path);
		while (list($i, $dir) = each($path)) {
			if (!empty($dir)) {
				$dirpath = $dirpath . $dir . "/";
				if (!@is_dir($dirpath)) @mkdir($dirpath);
			}
		}
		return $dirpath;
	}
	static function checkDir($path)
	{
		if ($path == '') return false;
		$path = preg_replace('|\\+|', ',', $path);
		if (@is_dir($path)) return true;
		else return @mkdir($path, 0777, true);
	}

	static function removeDirectory($dir)
	{
		if ($objs = @glob($dir . "/*"))
			foreach ($objs as $obj) if (is_dir($obj)) removeDirectory($obj);
			else unlink($obj);
		rmdir($dir);
	}

	static function GetFileVersionA($FileName)
	{
		$handle = fopen($FileName, 'rb');
		if (!$handle) return false;
		$Header = fread($handle, 64);
		if (substr($Header, 0, 2) != 'MZ') return false;
		$PEOffset = unpack("V", substr($Header, 60, 4));
		if ($PEOffset[1] < 64) return false;
		fseek($handle, $PEOffset[1], SEEK_SET);
		$Header = fread($handle, 24);
		if (substr($Header, 0, 2) != 'PE') return false;
		$Machine = unpack("v", substr($Header, 4, 2));
		if ($Machine[1] != 332) return false;

		$NoSections = unpack("v", substr($Header, 6, 2));
		$OptHdrSize = unpack("v", substr($Header, 20, 2));
		fseek($handle, $OptHdrSize[1], SEEK_CUR);
		$ResFound = false;

		for ($x = 0; x < $NoSections[1]; $x++) {
			$SecHdr = fread($handle, 40);
			if (substr($SecHdr, 0, 5) == '.rsrc') {
				$ResFound = true;
				break;
			}
		}
		if (!$ResFound) return false;

		$InfoVirt = unpack("V", substr($SecHdr, 12, 4));
		$InfoSize = unpack("V", substr($SecHdr, 16, 4));
		$InfoOff = unpack("V", substr($SecHdr, 20, 4));
		fseek($handle, $InfoOff[1], SEEK_SET);
		$Info = fread($handle, $InfoSize[1]);
		$NumDirs = unpack("v", substr($Info, 14, 2));
		$InfoFound = false;

		for ($x = 0; $x < $NumDirs[1]; $x++) {
			$Type = unpack("V", substr($Info, ($x * 8) + 16, 4));
			if ($Type[1] == 16) {
				$InfoFound = true;
				$SubOff = unpack("V", substr($Info, ($x * 8) + 20, 4));
				break;
			}
		}
		if (!$InfoFound) return false;

		$SubOff[1] &= 0x7fffffff;
		$InfoOff = unpack("V", substr($Info, $SubOff[1] + 20, 4));
		$InfoOff[1] &= 0x7fffffff;
		$InfoOff = unpack("V", substr($Info, $InfoOff[1] + 20, 4));
		$DataOff = unpack("V", substr($Info, $InfoOff[1], 4));
		$DataSize = unpack("V", substr($Info, $InfoOff[1] + 4, 4));
		$CodePage = unpack("V", substr($Info, $InfoOff[1] + 8, 4));
		$DataOff[1] -= $InfoVirt[1];
		$Version = unpack("v4", substr($Info, $DataOff[1] + 48, 8));
		$x = $Version[2];
		$Version[2] = $Version[1];
		$Version[1] = $x;
		$x = $Version[4];
		$Version[4] = $Version[3];
		$Version[3] = $x;
		return $Version;
	}

	static function GetFileVersion($FileName)
	{
		if (!@file_exists($FileName)) return '';
		$fso = new COM('Scripting.FileSystemObject');
		$version = $fso->GetFileVersion($FileName);
		if ($version != '') {
			$version = $version[0] . '.' . $version[2] . $version[4] . $version[6];
		}
		unset($fso);
		return $version;
	}

	static function linkFile($src, $type = "", $attrs = "")
	{
		$result = $src;
		if ($type === "false" || $type === false || $attrs === "false" || $attrs === false) return "";
		if ($type === true) $type = "";
		if ($attrs === true) $attrs = "";

		if ($src != "") {
			$compress = '';
			$stamp = "";
			if ($type == "compress") {
				$compress = 'z';
				$type = "";
			}
			if ($type == "" || $type === true) {
				$type = trim(strrchr($src, '.'), '.');
				$pos = strpos($type, '?');
				if ($pos !== false) $type = substr($type, 0, $pos);
			}
			if (substr($src, 0, 2) != "//" && substr($src, 0, 4) != "http" && @file_exists(self::root . $src)) $stamp .= "&" . str_replace(array('.', ':'), array('', ''), date('Y.m.dH:i:s', filemtime(self::root . $src)));
			if (false && $compress) $stamp .= "&compress";
			if ($attrs != "" && $attrs !== true && $attrs !== false) $attrs = " $attrs";
			if ($stamp != "") $stamp = "?" . trim($stamp, '&');
			switch ($type) {
				case "js":
					$result = "<script type='text/javascript'$attrs src='$src$compress$stamp'></script>";
					break; // crossorigin='anonymous'
				case "css":
					$result = "<link type='text/css' rel='stylesheet'$attrs href='$src$compress$stamp'>";
					break; // crossorigin='anonymous'
				case "ico":
					$result = "<link type='image/x-icon' rel='shortcut icon'$attrs href='$src$stamp'>";
					break; // crossorigin='anonymous'
				case "img":
					$result = "<link rel='image_src' href='$src$stamp'>";
					break; // crossorigin='anonymous'
				case "manifest":
					$result = "<link rel='manifest' href='$src$stamp'>";
					break; // crossorigin='anonymous'
			}
		}
		return $result;
	}

	static function getFilePath($filename)
	{
		return pathinfo($filename)[dirname];
	}
	static function getFileName($filename)
	{
		return pathinfo($filename)[basename];
	}
	static function getFileExtension($filename)
	{
		return pathinfo($filename)[extension];
	}

	static function getImageBase64($src)
	{
		if (!@file_exists(self::root . $src)) return "";
		return "data:" . @mime_content_type(self::root . $src) . ";base64," . @base64_encode(@file_get_contents(self::root . $src));
	}
}
//______________________________________________________________________________________________________________________________________________________________