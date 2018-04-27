<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Login extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library(array('session','form_validation','upload','email'));
		$this->load->helper(array('url','form'));
    }
    
    function index(){
        //$data['navegador']=get_browser(); 
        $data['token'] = $this->token();
        $data['title'] ='¡EMPIEZA LA COMPETENCIA!'; 
        switch ($this->session->userdata('perfil')){
            case '':
                $this->load->view('login/header.php',$data);
                $this->load->view('login/ingreso.php',$data);
                break;
            case '1':
                redirect(base_url().'admin');
                break;
            case '2':
                redirect(base_url().'cliente');
                break;
            default:
                $this->load->view('login/header.php',$data);
                $this->load->view('login/ingreso.php',$data);
            break;  
                
        }
    } 

	function validar(){
    if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
            $this->form_validation->set_rules('usuario','usuario','required|callback_username_check',
                                         array('required'=> 'INTRODUZCA SU CEDULA O EMAIL'));
            $this->form_validation->set_rules('password', 'Contraseña', 'required',
                                        array('required' => 'INTRODUZCA SU CONTRASEÑA'));
            if($this->form_validation->run() == FALSE){
                if(!empty($_POST['usuario']) && !empty($_POST['password'])){
                    $data = array(
                        'usuario' => form_error('usuario',' ',' '),
                        'password' => form_error('password',' ',' '),
                    );
                    echo json_encode($data);
                }else{
                    echo json_encode("Ingrese Usuario");
                }
            }else{
                $data['Cedula'] = $this->input->post('usuario');
                $data['password'] = $this->input->post('password');  
                $check_user = $this->login_model->login_user($data);
                if($check_user == TRUE){
                    if($check_user->estado == 1){              
                        $data = array(
                            'log_in'     => TRUE,
                            'perfil'     => $check_user->idTipo_usuario,
                            'username'   => $check_user->Nombre,
                            'foto'       => $check_user->idFotos,
                            'empresa'   =>$check_user->idEmpresas,
                            'correo'       => $check_user->Email,
                            'documento'  => $check_user->Cedula,
                            'cargo'=>       $check_user->cargo
                        );      
                        $this->session->set_userdata($data);
                        echo json_encode("1");
                    }else{
                        echo json_encode("CUENTA SIN ACTIVAR, REVISE SU CORREO");;
                    }
                }else{
                    header('Access-Control-Allow-Origin: *');
                    echo json_encode("CONTRASEÑA INCORRECTA");
                }
            }
            
        }else{
            echo "Error de Seguridad";
            //$this->index(); 
        }
    }
	 
    
    public function reenvio(){
        /*$mensaje=" ";
        foreach($_POST as $key => $value){
            $mensaje.= $key."=>".$value."/";
        }
        echo $mensaje;
        */
        $str=$_POST["user"];
        if (preg_match ("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $str)) { 
            $data['correo'] = $str;
            $check_mail = $this->login_model->value_mail($data);
            $email=$check_mail->Email;
            $cedula =$check_mail->Cedula;
        } else {
            if (preg_match ("/\\d+/", $str)) {
                $data['cedula'] = $str;
                $check_user = $this->login_model->value_user($data);
                $email=$check_user->Email;
                $cedula =$check_user->Cedula;
            }    
        } 
        
        $check_link=$this->login_model->buscar_token($cedula);
        $token=$check_link->Token;
        $enlace = base_url().'login/activacion/'.sha1($cedula).'/'.$token; 
        $VALUE=$this->enviarEmail( $email, $enlace ,2);
        echo $VALUE;
        //if() echo "1";
        //else                                        echo "2";
    }
    
    
    
    public function username_check($str){
        
        if (preg_match ("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $str)) { 
            $data['correo'] = $str;
            $check_mail = $this->login_model->value_mail($data);
                if($check_mail == FALSE){              
                    $this->form_validation->set_message('username_check', 'CORREO NO REGISTRADO');
                    return FALSE;
                }else  return TRUE;
        } else {
            if (preg_match ("/\\d+/", $str)) {
                $data['cedula'] = $str;
                $check_user = $this->login_model->value_user($data);
                if($check_user == FALSE){              
                    $this->form_validation->set_message('username_check', 'CEDULA NO REGISTRADA');
                    return FALSE;
                }else return true; 
                
            }else{
                    $this->form_validation->set_message('username_check', 'USUARIO NO REGISTRADO');
                    return FALSE;  
            }
        } 
    }
        
    public function exito(){
        $a=  $this->uri->segment(3);
        $data['token'] = $this->token();
        if($a == 1){
            $this->load->view('login/header.php',$data);
            $this->load->view('login/exitoso.php',$data);
        }
        if($a == 2){
            $this->load->view('login/header.php',$data);
            $this->load->view('login/exitosorecover.php',$data);
        }
        if($a == 3){
            $this->load->view('login/header.php',$data);
            $this->load->view('login/exitosocambio.php',$data);
        }
        if($a == 4){
            $this->load->view('login/header.php',$data);
            $this->load->view('login/exitoreenvio.php',$data);
        }
    }
    
	public function registro(){
        $data['token'] = $this->token();
        $this->load->view('login/header.php',$data);
        $this->load->view('login/registro.php',$data);
    }

    public function mail_check($str){
            $data['correo'] = $str;
            $check_mail = $this->login_model->value_mail($data);
            if($check_mail == TRUE){              
                $this->form_validation->set_message('mail_check', 'Email ya registrado');
                return FALSE;
            }else{
                return true;
            } 
        
    }
    
    public function cedula_check($str){
        $data['cedula'] = $str;
        $check_user = $this->login_model->value_user($data);
        if($check_user == TRUE){              
            $this->form_validation->set_message('cedula_check', 'Cedula ya registrada');
            return FALSE;
        }else{
            return true;
        }
    }
    
	public function registrarUsuario() {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                                              array('required'=>'Ingresa tu nombre y apellido'));
            $this->form_validation->set_rules('documento', 'Documento', 'required|callback_cedula_check|numeric',
                                              array('required'=>'Ingresa tu numero de cedula',
                                                    'numeric'=>'Solo ingrese numeros'));
            $this->form_validation->set_rules('empresa', 'Empresa', 'required',
                                              array('required'=>'Selecciona tu empresa'));
            $this->form_validation->set_rules('birthday', 'Cumpleaños', 'required',
                                              array('required'=>'Selecciona tu fecha de cumpleaños'));
            $this->form_validation->set_rules('cargo', 'Cargo', 'required',
                                              array('required'=>'Selecciona tu cargo'));
            $this->form_validation->set_rules('email', 'Email', 'callback_mail_check|required|valid_email',
                                              array('required'=>'Ingresa tu email corporativo',
                                                    'valid_email'=>'Ingresa un email valido'));
            $this->form_validation->set_rules('prefijos', 'Indice', 'required',
                                              array('required'=>'Escoja'));
            $this->form_validation->set_rules('celular', 'Celular', 'required|numeric',
                                              array('required'=>'Ingresa tu numero de celular',
                                                    'numeric'=>'Solo ingrese numeros'));
            $this->form_validation->set_rules('password', 'Contraseña', 'required',
                                              array('required'=>'Ingresa una contraseña'));
            $this->form_validation->set_rules('confirma', 'Contraseña', 'required|matches[password]',
                                              array('matches'=>'Las contraseñas no coinciden.',
                                                   'required'=>'Repite la contraseña ingresada'
                                                   ));
        
            if($this->form_validation->run() == FALSE){
                $data = array(
                        'nombre' => form_error('nombre',' ',' '),
                        'documento' => form_error('documento',' ',' '),
                        'empresa' => form_error('empresa',' ',' '),
                        'birthday' => form_error('birthday',' ',' '),
                        'cargo' => form_error('cargo',' ',' '),
                        'email' => form_error('email',' ',' '),
                        'prefijos' => form_error('prefijos',' ',' '),
                        'celular' => form_error('celular',' ',' '),
                        'password' => form_error('password',' ',' '),
                        'confirma' => form_error('confirma',' ',' '),
                    );
                    echo json_encode($data);
            }else{
                $data =array(
                    'Nombre'=>          $this->input->post('nombre'),
                    'Cedula'=>          $this->input->post('documento'),
				    'idEmpresas'=>      $this->input->post('empresa'),
				    'birthday'=>        $this->input->post('birthday'),
				    'cargo'=>           $this->input->post('cargo'),
				    'Email' =>          $this->input->post('email'),
					'Celular'=>         $this->input->post('celular'),
					'password' =>       $this ->input->post('password'),
					'idTipo_usuario'=>  2,	
                );
                if(isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])){
                    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                    if(in_array($_FILES['foto']['type'], $permitidos)){
                        $ex=$_FILES['foto']['name'];
                        $epld=explode('.',$ex);
                        $filename=date("mdyHis").".".$epld[1];
                        $userfile_size=$_FILES['foto']['size'];
                        $imggtype=$_FILES['foto']['type'];
                        move_uploaded_file($_FILES['foto']['tmp_name'],"./documentos/fotos/".$filename);
                                            
                        $subir = $this->login_model->subir($data['Cedula'],$filename);
                        if($subir) $data['idFotos']=$subir;
                        else       echo json_encode("2"); 
                    }else{
                        echo json_encode("3");
                    }
                }else               $data['idFotos']=1;  
                if($this->login_model->crearUsuario($data)){
                    if($linkTemporal = $this->generarLinkTemporal($data['Cedula'] ,2)){
                        $this->enviarEmail( $data['Email'], $linkTemporal ,2);
                        $name= explode(" ", $data['Nombre']);
                        $this->session->set_userdata('nombre',$name[0]);
                        echo json_encode(array('val'=>'1'));
                    }else{
                        echo json_encode("El usuario ha sido creado, para activar recurra a un administrador");
                    }
                }else{
                    echo json_encode("Error al Crear, Intente mas tarde.");
                } 
            }
        }
    
	public function recuperacion(){
        
        $data['token'] = $this->token();
        $this->load->view('login/header.php',$data);
        $this->load->view('login/recuperacion.php',$data);
    }
    
    public function politicas(){
        $this->load->view('login/header.php');
        $this->load->view('login/politicas-de-datos.php');
    }
       
    public function activacion(){
		$data['idusuario']=  $this->uri->segment(3);
		$data['token2']=  $this->uri->segment(4);
		$check_link = $this->login_model->value_link($data);
		if($check_link == TRUE){
            if(sha1($check_link->Usuario) == $data['idusuario']){
				$data['idusuario']=$check_link->Usuario;
				$data['token'] = $this->token();
                if($this->login_model->activate($data)){
                    $this->login_model->eliminarLink($data['idusuario']);
                    $data['title'] = "¡Cuenta activada! Ahora ingresa";
                }else{
                        $data['title'] = "Error al activar,Contacta al administrador";
                }
                //http://www.unifyandina.com/login/restablecer/117c3baf5cf3d19640026635f7e63d86a553add9/bf49a2bbda55000fd48ca36a5c1a28fd1f02efb9
				$this->load->view('login/header.php',$data);
                $this->load->view('login/ingreso.php',$data);
			}else{
				redirect(base_url(),'refresh');
			}
		}else{
			redirect(base_url(),'refresh');
		}
	}
    
	public function validarEmail(){
         if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
            $this->form_validation->set_rules('email', 'Email', 'required');
            if($this->form_validation->run() == FALSE){
                echo "Ingresa un Correo";
            }else{
                $data['correo'] = $this->input->post('email');
				$check_mail = $this->login_model->recover_mail($data);
				if($check_mail == TRUE){                  
					if($linkTemporal = $this->generarLinkTemporal(  $check_mail->Cedula,1 )){
                        $value=$this->enviarEmail( $data['correo'], $linkTemporal ,1);
                        echo "1";
					}else{
                        echo 'No se ha podido realizar el correo, Intente mas tarde o contacte con el administrador';  
                    }
				}else  echo 'No existe ese correo';  
			}
        }else
            echo 'Error en la validacion porfavor recarge la pagina';
        }  
            
    public function restablecer(){
		$data['idusuario']=  $this->uri->segment(3);
		$data['token2']=  $this->uri->segment(4);
		$check_link = $this->login_model->value_link($data);
		if($check_link == TRUE){
            if(sha1($check_link->Usuario) == $data['idusuario']){
				$data['idusuario']=$check_link->Usuario;
                $data['token'] = $this->token();
                $this->load->view('login/header.php',$data);
				$this->load->view('login/reestablecer.php',$data);	
			}else{
				redirect(base_url(),'refresh');
			}
		}else{
			redirect(base_url(),'refresh');
		}
		
	}
	
	public function cambioPass(){
			$this->form_validation->set_rules('password', 'Nueva', 'required',
                                              array('required'=>'Ingrese una contraseña'));
			$this->form_validation->set_rules('confirma', 'Confirmacion', 'required|matches[password]',
                                              array('matches'=>'Las contraseñas no coinciden.',
                                                    'required'=>'Repite la contraseña ingresada'));
			if($this->form_validation->run() == FALSE){
                $data = array(
                    'password' => form_error('password',' ',' '),
                    'confirma' => form_error('confirma',' ',' '),
                );
                echo json_encode($data);
            }else{
				$data =array(
                    'documento'=>$this->input->post('id'),
                    'password'=>$this->input->post('password'),
                ); 
				if($this->login_model->actualizarPassword($data)){
					$this->login_model->eliminarLink($data['documento']);
					echo '1'; 
				}else{
                    echo 'ERROR AL RECUPERAR CONTRASEÑA';
				}
			}
    }
                                              
	public function generarLinkTemporal($username,$a){
		$cadena = $username.$username.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);
		$data=array(
                    'Usuario' => $username,
                    'Token' => $token,
        );
		if($this->login_model->crearLink($data)){
			if($a==1)
                $enlace = base_url().'login/restablecer/'.sha1($username).'/'.$token;
			else
                $enlace = base_url().'login/activacion/'.sha1($username).'/'.$token;    
            return $enlace;
		}
		else
			return FALSE;
	}
	
	public function enviarEmail( $email, $link ,$a){
        if($a==1){
            $mensaje = $this->mailrecover($link);
            $this->load->library('email','MY_email');
            $this->email->from('hola@unifyandina.com', 'Unify Andina');
            $this->email->bcc('hola@unifyandina.com');
            $this->email->bcc('o@quevisiongrafica.com');
            $this->email->to($email);
            $this->email->subject('Aquí puedes cambiar tu contraseña.');               
            $this->email->message($mensaje); 
            if (!$this->email->send())
                return $this->email->print_debugger();
            else return TRUE;
        }else{
            $mensaje =   $mensaje = $this->mailactive($link);
             $this->load->library('email','MY_email');
            $this->email->from('hola@unifyandina.com', 'Unify Andina');
            $this->email->to($email);
            $this->email->bcc('hola@unifyandina.com');
            $this->email->bcc('o@quevisiongrafica.com');
            $this->email->subject('¡Activa tu cuenta ahora! y empieza la competencia');               
            $this->email->message($mensaje); 
            if (!$this->email->send())
                return $this->email->print_debugger();
            else return TRUE;
            
            
            /*
            
            $headers  = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=UTF-8\n";
            $headers .= "X-Priority: 3\n";
            $headers .= "X-MSMail-Priority: Normal\n";
            $headers .= "X-Mailer: php\n";
            $headers .= "From: Arturo de Unify 17 <Arturo@unify17.com>\n";
            $subject = "=?UTF-8?B?".base64_encode("¡Activa tu cuenta ahora! y empieza la competencia")."?=";
            mail($email,$subject,$mensaje,$headers);     */
        }
       
        
}
    
    function mailactive($link){
        return '<!doctype html>
<html lang="es" xmlns:og="http://opengraph.org/schema/">
    <head>
		<meta property="og:title" content="¡Activa tu cuenta ahora! y empieza la competencia"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />        
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>¡Activa tu cuenta ahora! y empieza la competencia</title>
        
        <style type="text/css">
            p{
                margin:10px 0;
                padding:0;
            }
            table{
                border-collapse:collapse;
            }
            h1,h2,h3,h4,h5,h6{
                display:block;
                margin:0;
                padding:0;
            }
            img,a img{
                border:0;
                height:auto;
                outline:none;
                text-decoration:none;
            }
            body,#bodyTable,#bodyCell{
                height:100%;
                margin:0;
                padding:0;
                width:100%;
            }
            #outlook a{
                padding:0;
            }
            img{
                -ms-interpolation-mode:bicubic;
            }
            table{
                mso-table-lspace:0pt;
                mso-table-rspace:0pt;
            }
            .ReadMsgBody{
                width:100%;
            }
            .ExternalClass{
                width:100%;
            }
            p,a,li,td,blockquote{
                mso-line-height-rule:exactly;
            }
            a[href^=tel],a[href^=sms]{
                color:inherit;
                cursor:default;
                text-decoration:none;
            }
            p,a,li,td,body,table,blockquote{
                -ms-text-size-adjust:100%;
                -webkit-text-size-adjust:100%;
            }
            .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
                line-height:100%;
            }
            a[x-apple-data-detectors]{
                color:inherit !important;
                text-decoration:none !important;
                font-size:inherit !important;
                font-family:inherit !important;
                font-weight:inherit !important;
                line-height:inherit !important;
            }
            #bodyCell{
                padding:10px;
            }
            .templateContainer{
                max-width:600px !important;
            }
            a.mcnButton{
                display:block;
            }
            .mcnImage{
                vertical-align:bottom;
            }
            .mcnTextContent{
                word-break:break-word;
            }
            .mcnTextContent img{
                height:auto !important;
            }
            .mcnDividerBlock{
                table-layout:fixed !important;
            }
            body,#bodyTable{
                background-color:#FAFAFA;
            }
            #bodyCell{
                border-top:0;
            }
            .templateContainer{
                border:0;
            }
            h1{
                color:#202020;
                font-family:Helvetica;
                font-size:26px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h2{
                color:#202020;
                font-family:Helvetica;
                font-size:22px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h3{
                color:#202020;
                font-family:Helvetica;
                font-size:20px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h4{
                color:#202020;
                font-family:Helvetica;
                font-size:18px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            #templatePreheader{
                background-color:#ffffff;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:9px;
                padding-bottom:9px;
            }
            #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                color:#656565;
                font-family:Helvetica;
                font-size:12px;
                line-height:100%;
                text-align:center;
            }
            #templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{
                color:#656565;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateHeader{
                background-color:#2a3136;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:2px solid #ffffff;
                padding-top:10px;
                padding-bottom:0;
            }
            #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                color:#202020;
                font-family:Helvetica;
                font-size:16px;
                line-height:150%;
                text-align:left;
            }
            #templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{
                color:#2a3136;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateBody{
                background-color:#ffffff;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:0px;
                padding-bottom:30px;
            }
            #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                color:#2a3136;
                font-family:Helvetica;
                font-size:16px;
                line-height:150%;
                text-align:center;
            }
            #templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{
                color:#c1c1c1;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateFooter{
                background-color:#2a3136;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:9px;
                padding-bottom:20px;
            }
            #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                color:#ffffff;
                font-family:Helvetica;
                font-size:12px;
                line-height:150%;
                text-align:center;
            }
            #templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{
                color:#ffffff;
                font-weight:normal;
                text-decoration:underline;
            }
                @media only screen and (min-width:768px){
                    .templateContainer{
                        width:600px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    body,table,td,p,a,li,blockquote{
                        -webkit-text-size-adjust:none !important;
                    }

            }	@media only screen and (max-width: 480px){
                    body{
                        width:100% !important;
                        min-width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #bodyCell{
                        padding-top:10px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImage{
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
                        max-width:100% !important;
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnBoxedTextContentContainer{
                        min-width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupContent{
                        padding:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
                        padding-top:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
                        padding-top:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardBottomImageContent{
                        padding-bottom:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupBlockInner{
                        padding-top:0 !important;
                        padding-bottom:0 !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupBlockOuter{
                        padding-top:9px !important;
                        padding-bottom:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnTextContent,.mcnBoxedTextContentColumn{
                        padding-right:18px !important;
                        padding-left:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
                        padding-right:18px !important;
                        padding-bottom:0 !important;
                        padding-left:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcpreview-image-uploader{
                        display:none !important;
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h1{
                        font-size:22px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h2{
                        font-size:20px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h3{
                        font-size:18px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h4{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templatePreheader{
                        display:block !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }
        </style>
    
<style type="text/css">

</style>
</head>
    <body style="height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #FAFAFA;">
                <tr>
                    <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;">
                        <!-- BEGIN TEMPLATE // -->
						<!--[if gte mso 9]>
						<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
						<tr>
						<td align="center" valign="top" width="600" style="width:600px;">
						<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;">
                            <tr>
                                <td valign="top" id="templateHeader" style="background:#2a3136 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #2a3136;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 2px solid #ffffff;padding-top: 10px;padding-bottom: 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/5292511c-a0df-46bb-a08d-91737f825148.png" width="331.5" style="max-width: 663px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateBody" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/3bca5d69-9918-4069-9869-b2f5484972ae.png" width="210" style="max-width: 420px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            <br>
<span style="font-size:32px"><span style="color:#88C540"><strong>Hola '.$this->session->userdata('nombre').'</strong></span></span>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            Gracias por registrarte en Unify Andina. Ahora estamos listos para activar tú cuenta. Todo lo que necesitamos hacer es asegurarnos de que ésta sea tú dirección de correo electrónico.<br>
<strong>¡Así que oprime el siguiente botón!</strong><br>
&nbsp;
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 290px;background-color: #88C540;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial;font-size: 18px;padding: 15px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <a class="mcnButton " title="¡Clic aquí para activar tu cuenta!" href="'.$link.'" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">¡Clic aquí para activar tu cuenta!</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            O copia y pega este enlace en tu navegador:<br>
'.$link.'<br>
<br>
En tu carpeta de spam puede haber mas información que te hemos enviado, revísala y sácanos de tu lista de spam!
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateFooter" style="background:#2a3136 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #2a3136;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 20px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">
                        
                            <span style="font-size:20px">www.unifyandina.com</span><br>
<br>
<strong>©&nbsp;</strong>Unify Co 2017<strong>, All rights reserved.</strong><br>
Consulta nuestras&nbsp;<a href="'.base_url().'politicas" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #ffffff;font-weight: normal;text-decoration: underline;">Política Tratamiento de Datos Personales</a>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
						<!--[if gte mso 9]>
						</td>
						</tr>
						</table>
						<![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
';
    }
    
    function mailrecover($link){
            return '<!doctype html>
<html lang="es" xmlns:og="http://opengraph.org/schema/">
    <head>
		<meta property="og:title" content="Aquí puedes cambiar tu contraseña."/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />        
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aquí puedes cambiar tu contraseña.</title>
        <style type="text/css">
            p{
                margin:10px 0;
                padding:0;
            }
            table{
                border-collapse:collapse;
            }
            h1,h2,h3,h4,h5,h6{
                display:block;
                margin:0;
                padding:0;
            }
            img,a img{
                border:0;
                height:auto;
                outline:none;
                text-decoration:none;
            }
            body,#bodyTable,#bodyCell{
                height:100%;
                margin:0;
                padding:0;
                width:100%;
            }
            #outlook a{
                padding:0;
            }
            img{
                -ms-interpolation-mode:bicubic;
            }
            table{
                mso-table-lspace:0pt;
                mso-table-rspace:0pt;
            }
            .ReadMsgBody{
                width:100%;
            }
            .ExternalClass{
                width:100%;
            }
            p,a,li,td,blockquote{
                mso-line-height-rule:exactly;
            }
            a[href^=tel],a[href^=sms]{
                color:inherit;
                cursor:default;
                text-decoration:none;
            }
            p,a,li,td,body,table,blockquote{
                -ms-text-size-adjust:100%;
                -webkit-text-size-adjust:100%;
            }
            .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
                line-height:100%;
            }
            a[x-apple-data-detectors]{
                color:inherit !important;
                text-decoration:none !important;
                font-size:inherit !important;
                font-family:inherit !important;
                font-weight:inherit !important;
                line-height:inherit !important;
            }
            #bodyCell{
                padding:10px;
            }
            .templateContainer{
                max-width:600px !important;
            }
            a.mcnButton{
                display:block;
            }
            .mcnImage{
                vertical-align:bottom;
            }
            .mcnTextContent{
                word-break:break-word;
            }
            .mcnTextContent img{
                height:auto !important;
            }
            .mcnDividerBlock{
                table-layout:fixed !important;
            }
            body,#bodyTable{
                background-color:#FAFAFA;
            }
            #bodyCell{
                border-top:0;
            }
            .templateContainer{
                border:0;
            }
            h1{
                color:#202020;
                font-family:Helvetica;
                font-size:26px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h2{
                color:#202020;
                font-family:Helvetica;
                font-size:22px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h3{
                color:#202020;
                font-family:Helvetica;
                font-size:20px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            h4{
                color:#202020;
                font-family:Helvetica;
                font-size:18px;
                font-style:normal;
                font-weight:bold;
                line-height:125%;
                letter-spacing:normal;
                text-align:left;
            }
            #templatePreheader{
                background-color:#ffffff;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:9px;
                padding-bottom:9px;
            }
            #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                color:#656565;
                font-family:Helvetica;
                font-size:12px;
                line-height:100%;
                text-align:center;
            }
            #templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{
                color:#656565;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateHeader{
                background-color:#2a3136;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:2px solid #ffffff;
                padding-top:15px;
                padding-bottom:0px;
            }
            #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                color:#202020;
                font-family:Helvetica;
                font-size:16px;
                line-height:150%;
                text-align:left;
            }
            #templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{
                color:#2a3136;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateBody{
                background-color:#ffffff;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:0px;
                padding-bottom:30px;
            }
            #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                color:#2a3136;
                font-family:Helvetica;
                font-size:16px;
                line-height:150%;
                text-align:center;
            }
            #templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{
                color:#c1c1c1;
                font-weight:normal;
                text-decoration:underline;
            }
            #templateFooter{
                background-color:#2a3136;
                background-image:none;
                background-repeat:no-repeat;
                background-position:center;
                background-size:cover;
                border-top:0;
                border-bottom:0;
                padding-top:9px;
                padding-bottom:20px;
            }
            #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                color:#ffffff;
                font-family:Helvetica;
                font-size:12px;
                line-height:150%;
                text-align:center;
            }
            #templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{
                color:#ffffff;
                font-weight:normal;
                text-decoration:underline;
            }
                @media only screen and (min-width:768px){
                    .templateContainer{
                        width:600px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    body,table,td,p,a,li,blockquote{
                        -webkit-text-size-adjust:none !important;
                    }

            }	@media only screen and (max-width: 480px){
                    body{
                        width:100% !important;
                        min-width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #bodyCell{
                        padding-top:10px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImage{
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
                        max-width:100% !important;
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnBoxedTextContentContainer{
                        min-width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupContent{
                        padding:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
                        padding-top:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
                        padding-top:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardBottomImageContent{
                        padding-bottom:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupBlockInner{
                        padding-top:0 !important;
                        padding-bottom:0 !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageGroupBlockOuter{
                        padding-top:9px !important;
                        padding-bottom:9px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnTextContent,.mcnBoxedTextContentColumn{
                        padding-right:18px !important;
                        padding-left:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
                        padding-right:18px !important;
                        padding-bottom:0 !important;
                        padding-left:18px !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcpreview-image-uploader{
                        display:none !important;
                        width:100% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h1{
                        font-size:22px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h2{
                        font-size:20px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h3{
                        font-size:18px !important;
                        line-height:125% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    h4{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    .mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templatePreheader{
                        display:block !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                        font-size:16px !important;
                        line-height:150% !important;
                    }

            }	@media only screen and (max-width: 480px){
                    #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                        font-size:14px !important;
                        line-height:150% !important;
                    }

            }
        </style>
    
<style type="text/css">

</style>
</head>
    <body style="height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #FAFAFA;">
                <tr>
                    <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;">
                        <!-- BEGIN TEMPLATE // -->
						<!--[if gte mso 9]>
						<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
						<tr>
						<td align="center" valign="top" width="600" style="width:600px;">
						<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;">
                            <tr>
                                <td valign="top" id="templateHeader" style="background:#2a3136 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #2a3136;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 2px solid #ffffff;padding-top: 15px;padding-bottom: 0px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/5292511c-a0df-46bb-a08d-91737f825148.png" width="331.5" style="max-width: 663px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateBody" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            <br>
<span style="font-size:32px"><span style="color:#88C540"><strong>¡Hola! </strong></span></span>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            Haz recibido este email porque se solicitó un restablecimiento de contraseña para tú cuenta en Unify Andina. Si no has solicitado este cambio, puedes ignorar este email de forma segura.<br>
<br>
Para elegir una nueva contraseña y completar tú solicitud, oprime el siguiente botón:<br>
&nbsp;
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="left" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 290px;background-color: #88C540;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial;font-size: 16px;padding: 20px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <a class="mcnButton " title="¡Clic aquí para cambiar tú contraseña!" href="'.$link.'" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">¡Clic aquí para cambiar tú contraseña!</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: center;">
                        
                            <div>O copia y pega este enlace en tu navegador:<br>
'.$link.'</div><br>
<br>
En tu carpeta de spam puede haber mas información que te hemos enviado, revísala y sácanos de tu lista de spam!

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/3bca5d69-9918-4069-9869-b2f5484972ae.png" width="210" style="max-width: 420px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateFooter" style="background:#2a3136 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #2a3136;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 20px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="600" style="width:600px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">
                        
                            <span style="font-size:20px">www.unifyandina.com</span><br>
<br>
<strong>©&nbsp;</strong>Unify Co 2017<strong>, All rights reserved.</strong><br>
Consulta nuestras&nbsp;<a href="'.base_url().'politicas" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #ffffff;font-weight: normal;text-decoration: underline;">Política Tratamiento de Datos Personales</a>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
						<!--[if gte mso 9]>
						</td>
						</tr>
						</table>
						<![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
';
    }
    
    public function logout(){
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}
        
    public function token(){
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}    
    
}
