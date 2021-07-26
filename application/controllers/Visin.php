<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visin extends CI_Controller {
	public function index()
	{
        $dataUrl=base_url('assets/sales.json');
        $dataStringJson=file_get_contents($dataUrl);
        $dataJson=json_decode($dataStringJson);
        $data=$dataJson[2]->data;      
        $output['region']=$this->region($data);
        $output['sales']=$this->sales($data);        
        $this->load->view('visin',$output);        
    }
    function sales($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Rep]) == false)
            {
                $result[$row->Rep]=$row->Units;
            }else{
                $units=$result[$row->Rep];
                $result[$row->Rep]=$units + $row->Units;
            }
        };
        //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Sales','Units']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }
    public function index()
	{
        $dataUrl=base_url('assets/sales.json');
        $dataStringJson=file_get_contents($dataUrl);
        $dataJson=json_decode($dataStringJson);
        $data=$dataJson[2]->data;      
        $output['region']=$this->region($data);
        $output['sales']=$this->sales($data);
        $output['produk']=$this->produk($data);        
        $this->load->view('visin',$output);        
    }
.
.
.
function produk($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Item]) == false)
            {
                $result[$row->Item]=$row->Units;
            }else{
                $units=$result[$row->Item];
                $result[$row->Item]=$units + $row->Units;
            }
        };
        //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Produk','Units']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }