<?php
class Dashboard_model extends CI_Model{
    function get_all_admin(){
        if($this->session->userdata('ses_level') == 1){
            $this->db->where('id_role !=', '1');
        }else if($this->session->userdata('ses_level') == 2){
            $this->db->where('id_role', '3');
        }
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('tbl_reselleradmin');
        return $query;
    }

    function insert_admin($kirimdata){
        $query = $this->db->insert('tbl_reselleradmin', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_adminBY($id_reselleradmin){
        $this->db->where('id_reselleradmin' , $id_reselleradmin);
        $query = $this->db->get('tbl_reselleradmin');
        return $query;
    }

    function update_admin($kirimdata, $id_reselleradmin){
        $this->db->where('id_reselleradmin', $id_reselleradmin);
        $query = $this->db->update('tbl_reselleradmin', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_admin($id_reselleradmin){
        $this->db->where('id_reselleradmin', $id_reselleradmin);
        $query = $this->db->delete('tbl_reselleradmin');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_kategori(){
        $this->db->order_by('jenis', 'ASC');
        $this->db->order_by('nama_kategori', 'ASC');
        $query = $this->db->get('tbl_kategori');
        return $query;
    }

    function get_all_kategoriWHERE(){
        $this->db->where('aktif_state' , '1');
        $this->db->order_by('jenis', 'ASC');
        $this->db->order_by('nama_kategori', 'ASC');
        $query = $this->db->get('tbl_kategori');
        return $query;
    }

    function insert_kategori($kirimdata){
        $query = $this->db->insert('tbl_kategori', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_kategoriBY($id_kategori){
        $this->db->where('id_kategori' , $id_kategori);
        $query = $this->db->get('tbl_kategori');
        return $query;
    }

    function update_kategori($kirimdata, $id_kategori){
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->update('tbl_kategori', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_kategori($id_kategori){
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->delete('tbl_kategori');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_catalog(){
        $this->db->select('tbl_catalog.*,tbl_kategori.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->order_by('tbl_catalog.no_eartag', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function insert_catalog($kirimdata){
        $query = $this->db->insert('tbl_catalog', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_catalogBY($id_catalog){
        $this->db->where('id_catalog' , $id_catalog);
        $query = $this->db->get('tbl_catalog');
        return $query;
    }

    function update_catalog($kirimdata, $id_catalog){
        $this->db->where('id_catalog', $id_catalog);
        $query = $this->db->update('tbl_catalog', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_catalog($id_catalog){
        $this->db->where('id_catalog', $id_catalog);
        $query = $this->db->delete('tbl_catalog');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_keranjangFilter($dari,$ke){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        if($dari != '' && $ke != '')
        {
            $this->db->where('update_date BETWEEN "'. date('Y-m-d', strtotime($dari)). '" and "'. date('Y-m-d', strtotime($ke)).'"');
            // $this->db->where('update_date>=', $dari);
            // $this->db->where('update_date<=', $ke);
        }
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_keranjangFilterBY($dari,$ke,$id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        $this->db->where('tbl_reselleradmin.id_reselleradmin', $id_reselleradmin);
        if($dari != '' && $ke != '')
        {
            $this->db->where('update_date BETWEEN "'. date('Y-m-d', strtotime($dari)). '" and "'. date('Y-m-d', strtotime($ke)).'"');
            // $this->db->where('update_date>=', $dari);
            // $this->db->where('update_date<=', $ke);
        }
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_total_keranjangBY($id_catalog){
        $this->db->select('COUNT(tbl_keranjang.id_catalog) AS jml');
        $this->db->from('tbl_keranjang');
        $this->db->group_by('id_reselleradmin');
        $this->db->where('id_catalog', $id_catalog);
        $query = $this->db->get();
        return $query;
    }

    function get_all_keranjang(){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_keranjangbulan(){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = date("m");
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        $this->db->where('MONTH(tbl_keranjang.update_date)', $bulan);
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_keranjangBY($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        $this->db->where('tbl_reselleradmin.id_reselleradmin', $id_reselleradmin);
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_keranjangbulanBY($id_reselleradmin){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = date("m");
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_keranjang.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_keranjang','tbl_keranjang.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_keranjang.id_reselleradmin');
        $this->db->where('tbl_keranjang.id_reselleradmin', $id_reselleradmin);
        $this->db->where('MONTH(tbl_keranjang.update_date)', $bulan);
        $this->db->order_by('tbl_keranjang.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function insert_keranjang($kirimdata){
        $query = $this->db->insert('tbl_keranjang', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_keranjang($id_reselleradmin,$id_catalog){
        $this->db->where('id_catalog', $id_catalog);
        $this->db->where('id_reselleradmin', $id_reselleradmin);
        $query = $this->db->delete('tbl_keranjang');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function insert_pilihankeranjang($kirimdata){
        $query = $this->db->insert('tbl_memilih_cart', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_pilihankeranjang($id_keranjang){
        $this->db->where('id_keranjang', $id_keranjang);
        $query = $this->db->delete('tbl_memilih_cart');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_all_pilihancartBY($id_keranjang){
        $this->db->DISTINCT();
        $this->db->select('id_keranjang,pilihan');
        $this->db->from('tbl_memilih_cart');
        $this->db->where('id_keranjang' , $id_keranjang);
        $query = $this->db->get();
        return $query;
    }

    function get_all_pilihancartBY2($id_reselleradmin){
        $this->db->DISTINCT();
        $this->db->select('id_keranjang,pilihan');
        $this->db->from('tbl_memilih_cart');
        $this->db->where('id_reselleradmin' , $id_reselleradmin);
        $query = $this->db->get();
        return $query;
    }

    function get_all_keranjangBY2($id_reselleradmin){
        $this->db->where('id_reselleradmin' , $id_reselleradmin);
        $query = $this->db->get('tbl_keranjang');
        return $query;
    }

    function get_all_customer(){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->order_by('tbl_customer.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_customerBYBanyak($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->where('tbl_reselleradmin.id_reselleradmin', $id_reselleradmin);
        $this->db->where('tbl_customer.status', '0');
        $query=$this->db->get();
        return $query;
    }

    function get_all_customerBY($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->where('tbl_reselleradmin.id_reselleradmin', $id_reselleradmin);
        $this->db->order_by('tbl_customer.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_customerBY2($id_reselleradmin){
        $this->db->where('id_reselleradmin' , $id_reselleradmin);
        $query = $this->db->get('tbl_customer');
        return $query;
    }

    function get_all_customerBY3($id_customer){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->where('tbl_customer.id_customer', $id_customer);
        $this->db->order_by('tbl_customer.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_customerBY4($id_reselleradmin,$id_catalog){
        $this->db->where('id_catalog' , $id_catalog);
        $this->db->where('id_reselleradmin' , $id_reselleradmin);
        $query = $this->db->get('tbl_customer');
        return $query;
    }

    function get_all_customerBYCatalog($id_catalog){
        $this->db->where('id_catalog' , $id_catalog);
        $query = $this->db->get('tbl_customer');
        return $query;
    }

    function get_all_customerBYNotif($id_notifikasi){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*,tbl_notifikasi.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->join('tbl_notifikasi','tbl_notifikasi.id_catalog=tbl_catalog.id_catalog');
        $this->db->where('tbl_notifikasi.id_notifikasi', $id_notifikasi);
        $query=$this->db->get();
        return $query;
    }

    function get_all_customerBYupload($id_customer){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*,tbl_upload_bukti.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->join('tbl_upload_bukti','tbl_upload_bukti.id_customer=tbl_customer.id_customer');
        $this->db->where('tbl_customer.id_customer', $id_customer);
        $this->db->order_by('tbl_customer.update_date', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_buktiupload($id_customer){
        $this->db->where('id_customer' , $id_customer);
        $query = $this->db->get('tbl_upload_bukti');
        return $query;
    }

    function insert_customer($kirimdata){
        $query = $this->db->insert('tbl_customer', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function update_customer($kirimdata, $id_catalog){
        $this->db->where('id_catalog', $id_catalog);
        $query = $this->db->update('tbl_customer', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_customer($id_customer){
        $this->db->where('id_customer', $id_customer);
        $query = $this->db->delete('tbl_customer');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function insert_bukti($kirimdata){
        $query = $this->db->insert('tbl_upload_bukti', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function update_bukti($kirimdata, $id_upload){
        $this->db->where('id_upload', $id_upload);
        $query = $this->db->update('tbl_upload_bukti', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function hapus_bukti($id_customer){
        $this->db->where('id_customer', $id_customer);
        $query = $this->db->delete('tbl_upload_bukti');
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function insert_notif($kirimdata){
        $query = $this->db->insert('tbl_notifikasi', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function update_notif($kirimdata, $id_notifikasi){
        $this->db->where('id_notifikasi', $id_notifikasi);
        $query = $this->db->update('tbl_notifikasi', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_notifAdmin($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*,tbl_notifikasi.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->join('tbl_notifikasi','tbl_notifikasi.id_catalog=tbl_catalog.id_catalog');
        $this->db->where('tbl_notifikasi.ke', $id_reselleradmin);
        $this->db->where('tbl_notifikasi.status_pesan', '0');
        $this->db->order_by('tbl_notifikasi.updatetgl_pesan', 'DESC');
        $query=$this->db->get();
        return $query;
    }

    function get_notifReseller($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*,tbl_notifikasi.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->join('tbl_notifikasi','tbl_notifikasi.id_catalog=tbl_catalog.id_catalog');
        $this->db->where('tbl_notifikasi.ke', $id_reselleradmin);
        $this->db->where('tbl_notifikasi.status_pesan', '0');
        $this->db->order_by('tbl_notifikasi.updatetgl_pesan', 'DESC');
        $query=$this->db->get();
        return $query;
    }

    function get_notifFromAdmin($id_reselleradmin){
        $this->db->select('tbl_catalog.*,tbl_kategori.*,tbl_customer.*,tbl_reselleradmin.*,tbl_notifikasi.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->join('tbl_customer','tbl_customer.id_catalog=tbl_catalog.id_catalog');
        $this->db->join('tbl_reselleradmin','tbl_reselleradmin.id_reselleradmin=tbl_customer.id_reselleradmin');
        $this->db->join('tbl_notifikasi','tbl_notifikasi.id_catalog=tbl_catalog.id_catalog');
        $this->db->where('tbl_notifikasi.ke', $id_reselleradmin);
        $this->db->where('tbl_notifikasi.status_pesan', '0');
        $this->db->order_by('tbl_notifikasi.updatetgl_pesan', 'DESC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_catalogSapi(){
        $this->db->select('tbl_catalog.*,tbl_kategori.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->where('tbl_kategori.jenis', '1');
        $this->db->order_by('tbl_catalog.no_eartag', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_catalogKambing(){
        $this->db->select('tbl_catalog.*,tbl_kategori.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->where('tbl_kategori.jenis', '2');
        $this->db->order_by('tbl_catalog.no_eartag', 'ASC');
        $query=$this->db->get();
        return $query;
    }
    
    function get_all_catalogSapiCari($batas_awal,$batas_akhir){
        $this->db->select('tbl_catalog.*,tbl_kategori.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->where('tbl_kategori.jenis', '1')->where('tbl_catalog.aktif_state', '1');
        $this->db->where('tbl_catalog.bobot >=', $batas_awal)->where('tbl_catalog.bobot <=', $batas_akhir);
        $this->db->order_by('tbl_catalog.no_eartag', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_catalogKambingCari($batas_awal,$batas_akhir){
        $this->db->select('tbl_catalog.*,tbl_kategori.*');
        $this->db->from('tbl_catalog');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_catalog.id_kategori');
        $this->db->where('tbl_kategori.jenis', '2')->where('tbl_catalog.aktif_state', '1');
        $this->db->where('tbl_catalog.bobot >=', $batas_awal)->where('tbl_catalog.bobot <=', $batas_akhir);
        $this->db->order_by('tbl_catalog.no_eartag', 'ASC');
        $query=$this->db->get();
        return $query;
    }

    function get_all_menucatalogSapi(){
        $this->db->where('jenis', '1');
        $this->db->where('aktif_state', '1');
        $query=$this->db->get('tbl_kategori');
        return $query;
    }

    function get_all_menucatalogKambing(){
        $this->db->where('jenis', '2');
        $this->db->where('aktif_state', '1');
        $query=$this->db->get('tbl_kategori');
        return $query;
    }

}
?>