<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exporter {
	
	public function __construct(){
		
	}
	
	//Export functions
	function clean_data(&$str) { 
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\n/", "\\n", $str); 
	}
	
	public function export_excel( $data, $name = 'website_data') {
		$filename = $name . '_' . date('Ymd') . ".xls";
		$this->_to_excel($data, $name);	
	}
	
	public function export_csv($data_list=array(),$file_name = "export_csv"){
		header("Content-type: text/comma-separated-values");
		header("Content-Disposition: attachment; filename=\"$file_name.csv\"");	
		header('Content-Description: File Transfer');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		
		$data="";
		if($data_list){
			$keys = array_keys($data_list[0]);
			foreach($keys as $k => $v){
					$keys[$k] = str_replace("\"","\"\"",$v);
			}
			$data .= '"'.implode('","',$keys)."\"\r\n";
			
			foreach($data_list as $row){
				foreach($row as $k => $v){
					$tmp[$k] = str_replace("\"","\"\"",$v);
				}
				$row = $tmp;
				$data .= '"'.implode('","',$row)."\"\r\n";
			}
		}
		echo $data;
	}
	
	private function _to_excel($res_array, $filename='exceloutput') {
		if (count($res_array) == 0) {
			  echo '<p>The table appears to have no data.</p>';
		}
		else {
			$data = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
				   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				   <html>
						<head>
							<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
							<style id="Classeur1_16681_Styles">
								td {
									border: 1px solid #000000;  
								}
								table {
									border-collapse: collapse; 
								}
							</style>
						</head>
						<body>
							<div id="Classeur1_16681" align=center x:publishsource="Excel">
								<table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">';
			$data .= '<tr>';
			
			//Print Header
			foreach(array_keys($res_array[0]) as $fn) {
				$data .= '<td class=xl2216681 nowrap><b>' . htmlspecialchars(stripslashes($fn)) . '</b></td>';
			}
			$data .= '</tr>';
			
			//Print Data
			foreach ($res_array as $row) {
				$data .= '<tr>';
				foreach($row as $value) {
					$data .= '<td class=xl2216681 nowrap>' . htmlspecialchars($value) . '</td>';
				}
				$data .= '</tr>';
			}
		
			$data .=               '</table>
							</div>
						</body>
					</html>'; 
		
			header("Content-type: application/excel");
			header("Content-Disposition: attachment; filename=$filename.xls");
			echo "$headers\n$data"; 
		}
	}
	
	
	
}