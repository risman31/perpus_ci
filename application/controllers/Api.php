<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
	parent::__construct();
	$this->load->model('MSudi');
	}

	public function index()
	{
        $status = array(
                'status' => 'Ok'
        );
		echo json_encode($status);
    }

    public function GetDataBuku()
    {
        $query = $this->MSudi->GetData('tbl_buku')->result();
        echo json_encode($query);
    }

    public function GetDataPeminjaman()
    {
        $query = $this->MSudi->GetData('tbl_pinjam')->result();
        echo json_encode($query);
    }

   
    public function PostDataPeminjaman()
    {
        $data = [
            'id_pinjam' => urldecode($this->uri->segment(3)),
            'pinjam_id' => urldecode($this->uri->segment(4)),
            'anggota_id' => urldecode($this->uri->segment(5)),
            'buku_id' => urldecode($this->uri->segment(6)),
            'status' => urldecode($this->uri->segment(7)),
            'tgl_pinjam' => urldecode($this->uri->segment(8)),
            'lama_pinjam' => urldecode($this->uri->segment(9)),
            'tgl_balik' => urldecode($this->uri->segment(10)),
            'tgl_kembali' => urldecode($this->uri->segment(11))
        ];
        $input = $this->MSudi->AddData('tbl_pinjam', $data);
        if($input){
            redirect('Api');;
        } else {
            echo "Error";
        }
    }


    public function PutDataPeminjaman()
    {
        $kd_peminjaman=urldecode($this->uri->segment(3));
        $update['kd_anggota']= urldecode($this->uri->segment(4));
        $update['kd_buku']= urldecode($this->uri->segment(5));
        $update['jumlah_pinjam']= urldecode($this->uri->segment(6));
        $update['tanggal_pinjam']= urldecode($this->uri->segment(7));
        $update=$this->MSudi->UpdateData('peminjaman','kd_peminjaman',$kd_peminjaman,$update);    
        if($update){
            redirect('Api');
        } else {echo 'Error';}
    }

    public function DeleteDataPeminjaman()
    {
        $pinjam_id=urldecode($this->uri->segment(4));
        $delete=$this->MSudi->DeleteData('tbl_pinjam','pinjam_id',$pinjam_id);
        if($delete){
            redirect('Api');
        } else {echo 'Error';}
    }
}
