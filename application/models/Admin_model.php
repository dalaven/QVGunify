<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
    
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
    
    function get_OC(){
        $query = $this->db->query('SELECT o.idOC,u.Nombre,u.Cedula ,u.idEmpresas, o.`Monto` , o.`numero` , o.`Mayorista` , o.`Preventa` ,f.`Ruta` AS foto
                                     FROM  `orden_de_compra` o, usuarios u,fotos f
                                     WHERE o.`check` =0
                                        AND o.`Usuarios_Cedula` = u.Cedula AND u.`idFotos` = f.`idFotos`');
    
        $this->db->order_by("idOC", "asc"); 
        if($query->num_rows()>=1)            return $query;
        else                                return false;
    
 }    
    
    function get_Oportunidades(){
        $query = $this->db->query('SELECT o.`idOpor`,u.Nombre,u.Cedula, u.idEmpresas, o.`Monto` , o.`Cliente` , o.Nombre AS Oportunidad, o.`Preventa`,f.`Ruta` AS foto 
                                     FROM  `oportunidades` o, usuarios u,fotos f
                                     WHERE o.`check` =0
                                     AND o.`Usuarios_Cedula` = u.Cedula AND u.`idFotos` = f.`idFotos`');
    
        $this->db->order_by("idOpor", "asc"); 
        if($query->num_rows()>=1)            return $query;
        else                                return false;
    
 }    
    
    function get_Eventos(){
        $query = $this->db->query('SELECT o.`idEvento` , u.Nombre,u.Cedula, u.idEmpresas, o.`Fecha` , o.Nombre AS Evento, o.`Mayorista` ,f.`Ruta` AS foto
FROM  `evento` o, usuarios u,fotos f
WHERE o.`check` =0
AND o.`Usuarios_Cedula` = u.Cedula AND u.`idFotos` = f.`idFotos`');
    
        $this->db->order_by("idEvento", "desc"); 
        if($query->num_rows()>=1)            return $query;
        else                                return false;
    
 }  
    
    function get_Certificados(){
        $query = $this->db->query('SELECT o.`id_certificado` , u.Nombre,u.Cedula, u.idEmpresas, o.`Ruta` ,f.`Ruta` AS foto
                                    FROM  `certificaciones` o, usuarios u,fotos f
                                    WHERE o.`check` =0
                                    AND o.`Usuarios_Cedula` = u.Cedula
                                    AND u.`idFotos` = f.`idFotos`');
    
        $this->db->order_by("id_certificado", "desc"); 
        if($query->num_rows()>=1)            return $query;
        else                                return false;
    
 }  
    
    function ranking(){
        $query = $this->db->query('SELECT @i := @i +1 AS POSICION, XX.Nombre, XX.idEmpresas, XX.Cargo, XX.Letras, XX.palabra, XX.L_U, XX.L_N, XX.L_I, XX.L_F, XX.L_Y, XX.L_1, XX.L_7, XX.Ruta
FROM (

SELECT @i :=0
)foo, (

SELECT FA.Cedula, FA.Nombre, FA.Ruta, FA.idEmpresas, FA.Cargo, QQ.Letras, RA.palabra, QQ.L_U, QQ.L_N, QQ.L_I, QQ.L_F, QQ.L_Y, QQ.L_1, QQ.L_7
FROM (

SELECT idPremio, Palabra
FROM premio
)RA, (

SELECT U . * , Ruta
FROM usuarios U, fotos F
WHERE U.`idFotos` = F.`idFotos`
)FA, (

SELECT (
L_U + L_N + L_I + L_F + L_Y + L_1 + L_7
) AS Letras, L . * 
FROM letras L
)QQ
WHERE RA.`idPremio` = QQ.`idLetras` 
AND RA.`idPremio` = FA.Cedula
GROUP BY FA.Cedula
ORDER BY RA.Palabra DESC , QQ.Letras DESC
)XX
WHERE XX.idEmpresas NOT LIKE  "UNIFY"
AND XX.idEmpresas NOT LIKE "Que Vision Grafica"
        ');
        if($query->num_rows()>=1)            return $query->result();
        else                                return false;
        
        
    }
    
    function actualizarRanking($documento){
        
    }
    
    function recover_name($cedula){
        $this->db->select('Email,Nombre');
        $this->db->where('Cedula',$cedula);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else return false;        
    }
    
    function ActualizarCheck($id,$valor){
        $update['check'] = $valor;
        $tabla= array('orden_de_compra','oportunidades','evento','certificaciones');
        $a= array('idOC','idOpor','idEvento','id_certificado');
        $this->db->where($a[$id['tipo']-1],$id['id']);
        $this->db->update($tabla[$id['tipo']-1],$update);
        if($this->db->affected_rows()== 1){
            return true; 
        }  
        else                                return false;
    }

    function Suma_monto($data){
        $result= $this->obtenerCedula($data['id'],$data['tipo']);
        $Cedula= $result[0]->Usuarios_Cedula;
        $Monto = $result[0]->Monto;
        if($data['tipo']== 1){
            $query = $this->db->query('INSERT INTO monto(`id_monto`,`ordenes`,Usuarios_Cedula) VALUES('.$Cedula.','.$Monto.','.$Cedula.') ON DUPLICATE KEY UPDATE ordenes=ordenes+'.$Monto);
            $this->letras($Cedula,1);
        }
        if($data['tipo']== 2){
            $query = $this->db->query('INSERT INTO monto(`id_monto`,`oportunidades`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `oportunidades`= oportunidades+1');
            $this->letras($Cedula,2);
        }
        if($data['tipo']== 3){
            $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_F`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_F`= L_F+1');
        }
        if($data['tipo']== 4){
            $query = $this->db->query('INSERT INTO letras(`idLetras`,`L_7`,Usuarios_Cedula) VALUES('.$Cedula.',1,'.$Cedula.') ON DUPLICATE KEY UPDATE `L_7`= L_7+1');
        }
        $this->db->query('INSERT INTO premio(`idPremio`,`Palabra`,Usuarios_Cedula) VALUES('.$Cedula.',0,'.$Cedula.') ON DUPLICATE KEY UPDATE `Palabra`= Palabra');
    }
    
    function obtenerDatos($id,$tipo){
        if($tipo== 1){
            $this->db->select('numero AS Nombre,check');
            $this->db->from('`orden_de_compra`');
            $this->db->where('`idOC`',$id);
            $query = $this->db->get();
            if( $query->num_rows()==1)          return $query->row();
            else                                return $this->db->last_query();
        }
        if($tipo== 2){
            $this->db->select('Nombre,check');
            $this->db->from('oportunidades');
            $this->db->where('idOpor',$id);
            $query = $this->db->get();
            if( $query->num_rows()==1)          return $query->row();
            else                                return $this->db->last_query();
        }
        if($tipo== 3){
            $this->db->select('Nombre,check');
            $this->db->from('evento');
            $this->db->where('idEvento',$id);
            $query = $this->db->get();
            if( $query->num_rows()==1)          return $query->row();
            else                                return $this->db->last_query();
        }
        if($tipo== 4){
            $this->db->select('Ruta AS Nombre,check');
            $this->db->from('certificaciones');
            $this->db->where('id_certificado',$id);
            $query = $this->db->get();
            if( $query->num_rows()==1)          return $query->row();
            else                                return $this->db->last_query();
        }
    }
    
    function obtenerCedula($id,$tipo){
        $tabla= array('orden_de_compra','oportunidades','evento','certificaciones');
        $a= array('idOC','idOpor','idEvento','id_certificado');
        $this->db->select('Usuarios_Cedula ,Monto');
        $this->db->from($tabla[$tipo-1]);
        $this->db->where($a[$tipo-1],$id);
        $search = $this->db->get();
        $result= $search->result();
        
        return $result;  
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
        if( $query->num_rows()==1) return true;
        else   return false;
    }
	
	function value_mail($data){
        $this->db->where('Email',$data['correo']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return true;
        else   return false;
    }
    
	function recover_mail($data){
        $this->db->where('Email',$data['correo']);
        $query=$this->db->get('usuarios');
        if( $query->num_rows()==1) return $query->row();
        else {
            $this->session->set_flashdata('bandera','No existe una cuenta asociada a ese correo.');
            redirect(base_url().'login/recuperacion','refresh');  
        }        
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

    function value_link($data){
		$this->db->where('Token',$data['token2']);
        $query=$this->db->get('resetpass');
        if( $query->num_rows()==1){
			return $query->row();			
		}
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
    
    function get_datos_tabla(){

        $delimitador = ";";
        $nueva_linea = "\r\n";

        $this->load->dbutil();
        $query = $this->db->query("
SELECT  u.Cedula,u.Nombre,u.Email,u.idEmpresas AS Empresa,u.cargo,u.Celular,u.birthday AS Cumpleaños
,        (SELECT IFNULL(COUNT( * ),0) FROM  `orden_de_compra` oc WHERE oc.`Usuarios_Cedula` = u.`Cedula` 		GROUP BY  `Usuarios_Cedula`) AS Ordenes_de_compra_registradas,
        (SELECT IFNULL(COUNT( * ),0) FROM  `orden_de_compra` oc WHERE oc.`Usuarios_Cedula` = u.`Cedula` AND `check`=1 	GROUP BY  `Usuarios_Cedula`) AS Ordenes_de_compra_aprobadas,
	(SELECT IFNULL(SUM(monto),0) FROM  `orden_de_compra` oc WHERE oc.`Usuarios_Cedula` = u.`Cedula`  		GROUP BY  `Usuarios_Cedula`) AS Ordenes_de_compra_monto,
	(SELECT IFNULL(COUNT( * ),0) FROM  `oportunidades` l 	WHERE l.`Usuarios_Cedula` = u.`Cedula` 			GROUP BY  `Usuarios_Cedula`) AS Oportunidades_de_negocio_registradas, 
	(SELECT IFNULL(COUNT( * ),0) FROM  `oportunidades` l 	WHERE l.`Usuarios_Cedula` = u.`Cedula` 	AND `check`=1 	GROUP BY  `Usuarios_Cedula`) AS Oportunidades_de_negocio_aprobadas, 
	(SELECT IFNULL(COUNT( * ),0) FROM  `evento` e 		WHERE e.`Usuarios_Cedula` = u.`Cedula` 			GROUP BY  `Usuarios_Cedula`) AS eventos_registrados, 
	(SELECT IFNULL(COUNT( * ),0) FROM  `evento` e 		WHERE e.`Usuarios_Cedula` = u.`Cedula` 	AND `check`=1 	GROUP BY  `Usuarios_Cedula`) AS eventos_aprobados, 
	(SELECT IFNULL(COUNT( * ),0) FROM  `certificaciones` c 	WHERE c.`Usuarios_Cedula` = u.`Cedula` 			GROUP BY  `Usuarios_Cedula`) AS Certificaciones_registradas,
	(SELECT IFNULL(COUNT( * ),0) FROM  `certificaciones` c 	WHERE c.`Usuarios_Cedula` = u.`Cedula` 	AND `check`=1 	GROUP BY  `Usuarios_Cedula`) AS Certificaciones_aprobadas,
	(SELECT IFNULL(palabra,0)    FROM  premio p		WHERE p.`Usuarios_Cedula` = u.`Cedula`) 					     AS palabras_completadas,
	(SELECT (IF(L.L_U>=1,1,0) + IF(L.L_N>=1,1,0) + IF(L.L_I>=1,1,0) + IF(L.L_F>=1,1,0) + IF(L.L_Y>=1,1,0) + IF(L.L_1>=1,1,0) + IF(L.L_7>=1,1,0))
				     FROM letras L 		WHERE L.`Usuarios_Cedula` = u.`Cedula`) 					             AS letras_activas,
                     case u.`estado`  when 0 then 'Sin Activar'  when 1 then 'Activada'  end as Estado
FROM  `usuarios` u
WHERE `idTipo_usuario`=2
AND u.idEmpresas NOT LIKE  'UNIFY'
AND u.idEmpresas NOT LIKE 'Que Vision Grafica'


");

        // generamos el csv
        $CSV_data      = $this->dbutil->csv_from_result($query, $delimitador, $nueva_linea);
        $CSV_data = chr(239) . chr(187) . chr(191) .$CSV_data;
        return $CSV_data;
    } 

    
    function get_datos_OC(){
        $delimitador = ";";
        $nueva_linea = "\r\n";
        $this->load->dbutil();
        $query = $this->db->query("SELECT u.Nombre,u.Cedula ,u.idEmpresas AS Empresa, o.`Monto` , o.`numero` , o.`Mayorista` ,                                  o.`Preventa`,
        case o.`check`  when 0 then 'Sin Revisar'  when 1 then 'Aprobado'  when 2 then 'Rechazado'  end as Estado
                                    FROM  `orden_de_compra` o, usuarios u
                                    WHERE o.`Usuarios_Cedula` = u.Cedula
                                    AND u.idEmpresas NOT LIKE  'UNIFY'
AND u.idEmpresas NOT LIKE 'Que Vision Grafica'
                                    
                                    ");
        $CSV_data      = $this->dbutil->csv_from_result($query, $delimitador, $nueva_linea);
        $CSV_data = chr(239) . chr(187) . chr(191) .$CSV_data;
        return $CSV_data;
    }
    function get_datos_LEADS(){
        $delimitador = ";";
        $nueva_linea = "\r\n";
        $this->load->dbutil();
        $query = $this->db->query("SELECT u.Nombre,u.Cedula, u.idEmpresas AS Empresa, o.`Monto` , o.`Cliente` , o.Nombre AS                                     Oportunidad,o.`Preventa`,
        case o.`check`  when 0 then 'Sin Revisar'  when 1 then 'Aprobado'  when 2 then 'Rechazado'  end as Estado
                                     FROM  `oportunidades` o, usuarios u
                                     WHERE o.`Usuarios_Cedula` = u.Cedula
                                     AND u.idEmpresas NOT LIKE  'UNIFY'
AND u.idEmpresas NOT LIKE 'Que Vision Grafica'");
        
        $CSV_data      = $this->dbutil->csv_from_result($query, $delimitador, $nueva_linea);
        $CSV_data = chr(239) . chr(187) . chr(191) .$CSV_data;
        return $CSV_data;
    }
    
    function get_datos_EVENTO(){
        $delimitador = ";";
        $nueva_linea = "\r\n";
        $this->load->dbutil();
        $query = $this->db->query("SELECT  u.Nombre,u.Cedula, u.idEmpresas AS Empresa, o.`Fecha` , o.Nombre AS Evento, o.`Mayorista`,
        case o.`check`  when 0 then 'Sin Revisar'  when 1 then 'Aprobado'  when 2 then 'Rechazado'  end as Estado
                                FROM  `evento` o, usuarios u
                                
                                WHERE o.`Usuarios_Cedula` = u.Cedula
                                AND u.idEmpresas NOT LIKE  'UNIFY'
AND u.idEmpresas NOT LIKE 'Que Vision Grafica'");
        $CSV_data      = $this->dbutil->csv_from_result($query, $delimitador, $nueva_linea);
        $CSV_data = chr(239) . chr(187) . chr(191) .$CSV_data;
        return $CSV_data;
    }
    
    function get_datos_CERTI(){
        $delimitador = ";";
        $nueva_linea = "\r\n";
        $this->load->dbutil();
        $query = $this->db->query("SELECT  u.Nombre,u.Cedula, u.idEmpresas AS Empresa, o.`Ruta` ,case o.`check`  when 0 then 'Sin Revisar'  when 1 then 'Aprobado'  when 2 then 'Rechazado'  end as Estado
                                    FROM  `certificaciones` o, usuarios u
                                    
                                    
                                    WHERE o.`Usuarios_Cedula` = u.Cedula
                                    AND u.`idEmpresas` NOT LIKE  'UNIFY'
AND u.`idEmpresas` NOT LIKE 'Que Vision Grafica'");
        $CSV_data      = $this->dbutil->csv_from_result($query, $delimitador, $nueva_linea);
        $CSV_data = chr(239) . chr(187) . chr(191) .$CSV_data;
        return $CSV_data;
    }
    
    
}