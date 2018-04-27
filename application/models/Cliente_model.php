<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function load_Foto($data){
        $this->db->where('idFotos',$data);
        $query=$this->db->get('fotos');
        if( $query->num_rows()==1) return $query->row();
        else {
            return false;
        }        
    }
    
     function load_Letras($data){
        $this->db->where('idLetras',$data);
        $query=$this->db->get('letras');
        if( $query->num_rows()==1) return $query->row();
        else {
            return false;
        }        
    }
    function load_Palabras($data){
        $this->db->where('idPremio',$data);
        $query=$this->db->get('premio');
        if( $query->num_rows()==1) return $query->row();
        else {
            return false;
        }        
    }
 
            function ranking($data){
        $query = $this->db->query(' SELECT @i := @i +1 AS POSICION
FROM 
(SELECT @i :=0)foo, 
(SELECT RA.idPremio AS Cedula
FROM 
(SELECT idPremio, Palabra FROM premio)RA, 
(SELECT (L_U + L_N + L_I + L_F + L_Y + L_1 + L_7) AS Letras,L.idLetras FROM letras L)QQ
WHERE RA.`idPremio` = QQ.`idLetras` 
GROUP BY RA.idPremio 
ORDER BY RA.Palabra DESC , QQ.Letras DESC
)XX
WHERE XX.Cedula ='.$data);
        
    if($query->num_rows()>=1){
        $query=$query->row();       
        return $query->POSICION;}
        else                                return "0";
        
        
       
    }
    function actualizarPassword($data){
        $update['password'] = $data['password'];
        $this->db->where('Cedula',$data['documento']);
        $this->db->update('usuarios',$update);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
        
    function actualizarUsuario($data){
        $update =array(
               'Nombre'=>        $data['Nombre'],
               'birthday'=>        $data['birthday'],
               'cargo'=>           $data['cargo'],
               'Celular'=>         $data['Celular'],
               'idFotos'=>         $data['idFotos']
        );
        $this->db->where('Cedula',$data['Cedula']);
        $this->db->update('usuarios',$update);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function guardarOrdenes($Cedula,$data){
        $total=0;
        for ($i = 0; $i < count($data['num']); $i++) {
            $insert = array(
                'Usuarios_Cedula' => $Cedula,
                'numero' => $data['num'][$i],
                'Mayorista' => $data['mayorista'][$i],
                'Monto	' => $data['monto'][$i],
                'Preventa' => $data['preventa'][$i],
            );    
            $this->db->insert('orden_de_compra', $insert);
            $total=$total+$this->db->affected_rows();
        }
        if($total > 0){
            return $total;
        }else{
            return false;
        }
    }
    
    function guardarOportunidades($Cedula,$data){
        $total=0;
        for ($i = 0; $i < count($data['cliente']); $i++) {
            $insert = array(
                'Usuarios_Cedula' => $Cedula,
                'Cliente' => $data['cliente'][$i],
                'Nombre' => $data['oportunidad'][$i],
                'Monto	' => $data['monto'][$i],
                'Preventa' => $data['preventa'][$i],
            );    
            $this->db->insert('oportunidades', $insert);
            $total=$total+$this->db->affected_rows();
        }
        if($total > 0){
            return $total;
        }else{
            return false;
        }
    }
    
    function actualizarFoto($id,$documento){
        $update['idFotos'] = $id;
        $this->db->where('Cedula',$documento);
        $this->db->update('usuarios',$update);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function actualizarReto($documento){
        $this->db->select('*');
        $this->db->from('letras');
        $this->db->where('idLetras',$documento);
        $search = $this->db->get();
        if($search->num_rows()>=1){
            $result= $search->result();
            $U=     $result[0]->L_U;
            $N=     $result[0]->L_N;
            $I=     $result[0]->L_I;
            $F=     $result[0]->L_F;
            $Y=     $result[0]->L_Y;
            $uno=   $result[0]->L_1;
            $siete= $result[0]->L_7;
        }
        $update['L_U'] = $U-1;
        $update['L_N'] = $N-1;
        $update['L_I'] = $I-1;
        $update['L_F'] = $F-1;
        $update['L_Y'] = $Y-1;
        $update['L_1'] = $uno-1;
        $update['L_7'] = $siete-1;
        $this->db->where('idLetras',$documento);
        $this->db->update('letras',$update);
        $this->db->query('INSERT INTO premio(`idPremio`,`Palabra`,Usuarios_Cedula) VALUES('.$documento.',1,'.$documento.') ON DUPLICATE KEY UPDATE `Palabra`= Palabra+1');
        $this->letras($documento,1);
        $this->letras($documento,2);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function letras($Cedula,$tipo){
        if($tipo == 1){
            $this->db->select('ordenes');
            $this->db->from('monto');
            $this->db->where('id_monto',$Cedula);
            $search = $this->db->get();
            $result= $search->result();
            $monto= $result[0]->ordenes;
            
            $this->db->select('L_U,L_I ,L_Y,L_1');
            $this->db->from('letras');
            $this->db->where('idLetras',$Cedula);
            $search = $this->db->get();
            if($search->num_rows()>=1){
                $result= $search->result();
                $U=     $result[0]->L_U;
                $I=     $result[0]->L_I;
                $Y=     $result[0]->L_Y;
                $uno=   $result[0]->L_1;
            } else{
                $U=0;
                $I=0;
                $Y=0;
                $uno=0;
            }
            while($monto>=6000){
                if($U == 0 && $monto>= 6000){
                    $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_U`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_U`= L_U+1');
                    $query = $this->db->query('UPDATE monto SET ordenes = ordenes-6000 WHERE id_monto ='.$Cedula);
                    $monto=$monto-6000;
                    $U=1;
                }else{
                    if($I == 0 && $monto>= 30000){
                        $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_I`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_I`= L_I+1');
                        $query = $this->db->query('UPDATE monto SET ordenes = ordenes-30000 WHERE id_monto ='.$Cedula);
                        $monto=$monto-30000;
                        $I=1;
                    }else{
                        if($Y==0 && $monto>= 30000){
                            $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_Y`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_Y`= L_Y+1');
                            $query = $this->db->query('UPDATE monto SET ordenes = ordenes-30000 WHERE id_monto ='.$Cedula);
                            $monto=$monto-30000;
                            $Y=1;
                        }else{
                            if($uno==0 && $monto>= 30000){
                                $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_1`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_1`= L_1+1');
                                $query = $this->db->query('UPDATE monto SET ordenes = ordenes-30000 WHERE id_monto ='.$Cedula);
                                $monto=$monto-30000;
                                $uno=1;
                            }else{
                                break;
                            }
                        }
                    }
                }
            }
        }
        if($tipo == 2){
            $this->db->select('oportunidades');
            $this->db->from('monto');
            $this->db->where('id_monto',$Cedula);
            $search = $this->db->get();
            $result= $search->result();
            $cantidad= $result[0]->oportunidades;
            if($cantidad >=5){
                $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_N`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_N`= L_N+1');
                $query = $this->db->query('UPDATE monto SET oportunidades = oportunidades-5 WHERE id_monto ='.$Cedula);
                
            }
        }
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
    
    function subirCerti($usuario,$imagen){
        $data = array(
            'Usuarios_Cedula' => $usuario,
            'Ruta' => $imagen
        );
        $this->db->insert('certificaciones', $data);
        if($this->db->affected_rows()== 1)  return true;
        else                                return false;
    }
    
    function guardarEventos($Cedula,$data){
        $total=0;
        for ($i=0; $i < count($data['Nombre']); $i++) {
            $insert = array(
                'Nombre' => $data['Nombre'][$i],
                'Mayorista' => $data['Mayorista'][$i],
                'Fecha' => $data['Fecha'][$i],
                'Usuarios_Cedula	' => $Cedula,
            );  
            $this->db->insert('evento', $insert);
            $total=$total+$this->db->affected_rows();
        }
        if($total > 0){
            return $total;
        }else{
            return false;
        }    
        
        
        
        
        
        
    }
    
    function buscarPassword($data){
        $this->db->where('Cedula',$data);
        $this->db->select('password');
        $query = $this->db->get('usuarios');
        if($this->db->affected_rows()== 1)  return $query->row();
        else                                return false;
    }
    
    function login_user($data){
        $this->db->where('Cedula',$data);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else {
            $this->session->set_flashdata('bandera','Los datos introducidos son incorrectos'.$query->num_rows());
            redirect(base_url(),'refresh');   
        }        
    }
    
}