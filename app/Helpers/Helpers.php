<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helpers {
   public static function formatTanggal($tgl) 
    {
    	$bulanArray =array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $tgle = explode('-',$tgl);
        $bulan = $tgle[1] < 10 ? str_replace('0','',$tgle[1]) : $tgl[1];
        return $tgle[2].'-'.$bulanArray[$bulan].'-'.$tgle[0];   
	} 
	public static function hari()
	{
	$hari = date ("D"); 
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
	
		return  $hari_ini ;
	}

}