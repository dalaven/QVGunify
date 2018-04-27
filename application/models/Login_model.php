<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function login_user($data){
        $this->db->where('Cedula',$data['Cedula']);
        $this->db->where('password',$data['password']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else {
            $this->db->where('Email',$data['Cedula']);
            $this->db->where('password',$data['password']);
            $query=$this->db->get('usuarios');
            if( $query->num_rows()==1) return $query->row();
            else false;   
        }
    }
    
	function value_user($data){
        $this->db->where('Cedula',$data['cedula']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else   return false;
    }
	
	function value_mail($data){
        $this->db->where('Email',$data['correo']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else   return false;
    }
    
	function recover_mail($data){
        $this->db->where('Email',$data['correo']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else return false;        
    }
    
	function crearUsuario($data){
        $this->db->insert('usuarios',$data);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function subir($titulo,$imagen){
        $data = array(
            'Nombre' => $titulo,
            'Ruta' => $imagen
        );
        $this->db->insert('fotos', $data);
        $last_id = $this->db->insert_id();
        if($this->db->affected_rows()== 1){
            return $last_id;
        }else{
            return false;
        }
        
    }
	
	function crearLink($data){
        $this->db->insert('resetpass',$data);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function buscar_token($Cedula){
        $this->db->where('Usuario',$Cedula);
        $this->db->limit(1);
        $query=$this->db->get('resetpass');
        if( $query->num_rows()==1)return $query->row();
        else   return false;
    }

    function value_link($data){
		$this->db->where('Token',$data['token2']);
        $query=$this->db->get('resetpass');
        if( $query->num_rows()==1)return $query->row();
        else   return false;
	}
        
	function actualizarPassword($data){
        $update['password'] = $data['password'];
        $this->db->where('Cedula',$data['documento']);
        $this->db->update('usuarios',$update);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function activate($data){
        $update['estado'] = 1;
        $this->db->where('Cedula',$data['idusuario']);
        $this->db->update('usuarios',$update);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }

	function eliminarLink($data){
        $this->db->where('Usuario', $data);
        $this->db->delete('resetpass');
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    
}