<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cliente extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
        $this->load->model('cliente_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		
	}
	
	public function index(){
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['boton']="progreso";
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $letras=$this->cliente_model->load_Letras($this->session->userdata('documento'));
        $data['letras']=$letras;
        $complete=$this->cliente_model->load_Palabras($this->session->userdata('documento'));
        $data['Cargo']=$this->session->userdata('cargo');
        $data['palabra']=$complete;
        $this->load->view('Cliente/header.php',$data);
		$this->load->view('Cliente/progreso.php',$data);
                
	}
    
    public function perfil(){
                if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        
        $data['Cargo']=$this->session->userdata('cargo');
        $data['ranking']=$this->cliente_model->ranking($this->session->userdata('documento'));
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/perfil',$data);
    }
    
    public function password(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
        $this->load->view('Cliente/cambiopass',$data);
        $this->load->view('Cliente/footer.php',$data);
    }
    
	public function settings(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
            $data=$this->session->userdata('documento');
            $check_user = $this->cliente_model->login_user($data);              
            $data = array(
                            'Nombre'   => $check_user->Nombre,
                            'idEmpresas' => $check_user->idEmpresas,
                            'cargo' => $check_user->cargo,
                            'Cedula' => $check_user->Cedula,
                            'Email'     => $check_user->Email,
                            'Celular'     => $check_user->Celular,
                            'birthday'  =>$check_user->birthday,
            ); 
            $data['token'] = $this->token();
            $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
            $data['foto_perfil'] = $fotos->Ruta;
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/actualizardatos.php',$data);
    }
    
    public function oCompras(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="agregar";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
        $this->load->view('Cliente/ordendecompra',$data);
    }
    
    public function certificacion(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="agregar";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/certificaciones.php');
    }
    
    public function oportunidad(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="agregar";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
        $this->load->view('Cliente/leads',$data);
    }
    
    public function evento(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $data['boton']="agregar";
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
        $this->load->view('Cliente/eventos',$data);
    }
    
    public function asistencia(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/asistencia.php',$data);
    }
    
    public function politicas(){
         if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/politicas-de-datos.php');
        $this->load->view('Cliente/footer.php',$data);
    }
    
    public function detalles(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="progreso";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $data['Cargo']=$this->session->userdata('cargo');
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/detalles');
        $this->load->view('Cliente/footer.php',$data);
    }
    
    public function agregar(){
         if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="agregar";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
		$this->load->view('Cliente/agregar.php');
    }
    
    public function exito(){
        $a=  $this->uri->segment(3);
        $data['token'] = $this->token();
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        if($a == 1){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Cliente/botonera.php',$data);
		    $this->load->view('Cliente/exitomail.php');
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 2){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Cliente/botonera.php',$data);
            $this->load->view('Cliente/exitopass',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 3){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Cliente/botonera.php',$data);
            $this->load->view('Cliente/exitosend.php',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 4){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Cliente/botonera.php',$data);
            $this->load->view('Cliente/exitoupdate',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 5){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Cliente/botonera.php',$data);
            $this->load->view('Cliente/exitotrivia',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
    }
    
    public function faq(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '2'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Cliente/botonera.php',$data);
		$this->load->view('Cliente/faq.php');
        $this->load->view('Cliente/footer.php',$data);
        
    }
    //FIN DE VISTAS
    
    public function resetreto(){
        $this->cliente_model->actualizarReto($this->session->userdata('documento'));
    }
    
    public function subirCertificado(){
        $files = $_FILES['certificado']['name'];
        $i = 0;
        $validar["validacion"]=0;
        
        if(!is_dir("./documentos/certificaciones/")) 
            mkdir("./documentos/certificaciones/", 0777);
        
        foreach($files as $file){
            if(isset($_FILES['certificado']['name'][$i]) && !empty($_FILES['certificado']['name'][$i])){
                if($_FILES['certificado']['type'][$i] == "application/pdf"){
                    }else{
                    $validar['#sectionCreate-'.$i]="Solo se admite PDF";
                    $validar["validacion"]=1;
                }
            }else{
                $validar['#sectionCreate-'.$i]="No selecciono Archivo";
                $validar["validacion"]=1;
            }
            $i++;
        }
        $i=0;
        if($validar["validacion"]==0){
            foreach($files as $file) {
                $ex=$_FILES['certificado']['name'][$i];
                $epld=explode('.',$ex);
                $filename=$ex;
                $userfile_size=$_FILES['certificado']['size'][$i];
                $imggtype=$_FILES['certificado']['type'][$i];     
                move_uploaded_file($_FILES['certificado']['tmp_name'][$i],"./documentos/certificaciones/".$filename);
                $this->cliente_model->subirCerti($data=$this->session->userdata('documento'),$filename);
                $i++;
            }
            echo json_encode("1");               
        }else    echo json_encode($validar);
        
    }
    
    public function guardarOportunidad(){
            $this->form_validation->set_rules('cliente[]', 'cliente', 'required');
            $this->form_validation->set_rules('leads[]', 'oportunidad', 'required');
            $this->form_validation->set_rules('monto[]', 'monto', 'required');
            $this->form_validation->set_rules('preventa[]', 'preventa', 'required');
        
            if($this->form_validation->run() == FALSE){
                echo json_encode("campos Vacios");
            }else{
                $data =array(
                        'cliente'=>         $this->input->post('cliente'),
                        'oportunidad'=>     $this->input->post('leads'),
				        'monto'=>           $this->input->post('monto'),
				        'preventa'=>        $this->input->post('preventa'),

                        );
                $value=1;
                $longitud = count($data['monto']);
                for($i=0; $i<$longitud; $i++){
                  if($data['monto'][$i]<20000){
                        $value=0;
                  }
                }
                if($value){
                $total=$this->cliente_model->guardarOportunidades($this->session->userdata('documento'),$data);
                if($total)         echo json_encode('1');
                else               echo json_encode('2');
            }else{echo json_encode("VALOR mínimo debe ser de $20.000 USD para ser aceptado");}
            }
    }
    
    public function guardarEvento(){
            $this->form_validation->set_rules('eventos[]', 'evento', 'required',array('required'=>'Requerido'));
            $this->form_validation->set_rules('mayorista[]', 'mayorista', 'required',array('required'=>'Requerido'));
            $this->form_validation->set_rules('fecha[]', 'fecha', 'required',array('required'=>'Requerido'));
        
            if($this->form_validation->run() == FALSE){
                echo json_encode("campos Vacios");
            }else{
                $data =array(
                        'Nombre'=>         $this->input->post('eventos'),
                        'Mayorista'=>     $this->input->post('mayorista'),
				        'Fecha'=>           $this->input->post('fecha')
                        );
                $total=$this->cliente_model->guardarEventos($this->session->userdata('documento'),$data);
                if($total)         echo json_encode('1');
                else               echo json_encode('2');
                      
            }
    }
    
    public function ordenCompras(){
            $this->form_validation->set_rules('ordencompra[]', 'ordenc', 'required');
            $this->form_validation->set_rules('mayorista[]', 'mayorista', 'required');
            $this->form_validation->set_rules('monto[]', 'monto', 'required');
            $this->form_validation->set_rules('preventa[]', 'preventa', 'required');
        
            if($this->form_validation->run() == FALSE){
                echo json_encode("campos Vacios");
            }else{
                
                    $data =array(
                        'num'=>          $this->input->post('ordencompra'),
                        'mayorista'=>          $this->input->post('mayorista'),
				        'monto'=>      $this->input->post('monto'),
				        'preventa'=>        $this->input->post('preventa'),

                        );
                    $longitud = count($data['monto']);
                    $value=1;
                for($i=0; $i<$longitud; $i++){
                  if($data['monto'][$i]<6000){
                        $value=0;
                  }
                }
                if($value){
                    $total=$this->cliente_model->guardarOrdenes($this->session->userdata('documento'),$data);
                    if($total)         echo json_encode('1');
                    else               echo json_encode('2');
                }else{
                    echo json_encode("VALOR mínimo debe ser de $6.000 USD para ser aceptado");}
            }
    }
    
    public function actualizacionDatos() {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                                             array('required'=>'Ingrese Nombre'));
            $this->form_validation->set_rules('birthday', 'Cumpleaños', 'required',
                                             array('required'=>'Ingrese su cumpleaños'));
            $this->form_validation->set_rules('cargo', 'Cargo', 'required',
                                             array('required'=>'Seleccione un cargo'));
            $this->form_validation->set_rules('celular', 'Celular', 'required',
                                             array('required'=>'Ingrese Celular'));
            $this->form_validation->set_rules('password', 'Contraseña', 'required|callback_checkpass',
                                             array('required'=>'Ingrese Contraseña'));

            if($this->form_validation->run() == FALSE){
                $data = array(
                        'nombre'        => form_error('nombre',' ',' '),
                        'documento'     => form_error('documento',' ',' '),
                        'empresa'       => form_error('empresa',' ',' '),
                        'birthday'      => form_error('birthday',' ',' '),
                        'cargo'         => form_error('cargo',' ',' '),
                        'celular'       => form_error('celular',' ',' '),
                        'password'       => form_error('password',' ',' '),
                    );
                echo json_encode($data);
            }else{
                $data =array(
                    'Nombre'=>          $this->input->post('nombre'),
                    'Cedula'=>          $this->input->post('documento'),
                    'birthday'=>        $this->input->post('birthday'),
                    'cargo'=>           $this->input->post('cargo'),
                    'Celular'=>         $this->input->post('celular'),
                    'password' =>       $this ->input->post('password'),
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
                                            
                        $subir = $this->cliente_model->subir($data['Cedula'],$filename);
                        if($subir) {
                            $this->session->unset_userdata('foto');
                            $this->session->set_userdata(array('foto'  => $subir));
                            $data['idFotos']=$subir;
                        }
                        else       $data['idFotos']=$this->session->userdata('foto'); 
                    }else{
                    }
                }else               $data['idFotos']=$this->session->userdata('foto');  
                $subir=$this->cliente_model->actualizarUsuario($data);
                if($subir)  {
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('cargo');
                    $this->session->set_userdata(array('username'  => $data['Nombre']));
                    $this->session->set_userdata(array('cargo'  => $data['cargo']));
                    
                    echo json_encode("1");}
                else                                                echo json_encode("2");
                   
                }
            }
    
    public function enviarasistencia(){
        $this->form_validation->set_rules('comentarios', 'comentarios', 'required',array('required' => 'Por favor llene el campo'));        
        
        if($this->form_validation->run() == FALSE){
           echo form_error('comentarios',' ',' ');
        }else{
            $mensaje = '   
<!doctype html>
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
                text-align:left;
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
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="left" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/5292511c-a0df-46bb-a08d-91737f825148.png" width="331.5" style="max-width: 663px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
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
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">
                        
                            <br>
<span style="font-size:32px"><span style="color:#88C540"><strong>Hola</strong></span></span>
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
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">
                        
                            '.$this->input->post('comentarios').'<br>
<br>
Nombre:&nbsp;'.$this->session->userdata('username').'<br>
Empresa:&nbsp;'.$this->session->userdata('empresa').'<br>
Email:&nbsp;'.$this->session->userdata('correo').'<br>
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
                                <a class="mcnButton " title="¡Clic aquí para ingresar!" href="http://www.unifyandina.com" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">¡Clic aquí para ingresar!</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
Consulta nuestras&nbsp;<a href="http://www.unifyandina.com/Cliente/politicas" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #ffffff;font-weight: normal;text-decoration: underline;">Política Tratamiento de Datos Personales</a>
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

            $this->load->library('email','MY_email');
            $this->email->from('hola@unifyandina.com', 'Unify Andina');
            $this->email->to('juan.gomez@unify.com');
            $this->email->cc('jagomezrueda@gmail.com');
            $this->email->bcc('hola@unifyandina.com');
            $this->email->bcc('o@quevisiongrafica.com');
            $this->email->subject('Solicitud de asistencia Unify Andina');               
            $this->email->message($mensaje); 
            if (!$this->email->send())
                echo $this->email->print_debugger();
            else echo "1";
        }
    }
    
    public function enviarTrivia(){
        $this->form_validation->set_rules('trivia__1', 'campo1', 'required',array('required' => 'Por favor llene el campo'));
        $this->form_validation->set_rules('trivia__2', 'campo2', 'required',array('required' => 'Por favor llene el campo'));
        $this->form_validation->set_rules('trivia__3', 'campo3', 'required',array('required' => 'Por favor llene el campo'));        
        
        if($this->form_validation->run() == FALSE){
            $data = array(
                        'trivia__1'        => form_error('trivia__1',' ',' '),
                        'trivia__2'        => form_error('trivia__2',' ',' '),
                        'trivia__3'        => form_error('trivia__3',' ',' '),
                    );
                //echo json_encode($data);
            echo "2";
        }else{
            $mensaje = '<!doctype html>
                <html lang="es" xmlns:og="http://opengraph.org/schema/">
        <head>
        <meta property="og:title" content="¡Activa tu cuenta ahora! y empieza la competencia"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />        
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Trivia</title>
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
                text-align:left;
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
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px;padding-left: 0px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                
                                    
                                        <img align="left" alt="" src="https://gallery.mailchimp.com/f6b3fc2ab2b0d7e61d5ead4da/images/5292511c-a0df-46bb-a08d-91737f825148.png" width="331.5" style="max-width: 663px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">
                                    
                                
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
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">
                        
                            <br>
<span style="font-size:32px"><span style="color:#88C540"><strong>Hola</strong></span></span>
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
                        
                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #2a3136;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">
Nombre:&nbsp;'.$this->session->userdata('username').'<br>
Empresa:&nbsp;'.$this->session->userdata('empresa').'<br>
Email:&nbsp;'.$this->session->userdata('correo').'<br><br><br>
Respuesta 1:&nbsp;'.$this->input->post('trivia__1').'<br>
Respuesta 2:&nbsp;'.$this->input->post('trivia__2').'<br>
Respuesta 3:&nbsp;'.$this->input->post('trivia__3').'<br>
                        
                        
<br>
<br>

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
                                <a class="mcnButton " title="¡Clic aquí para ingresar!" href="http://www.unifyandina.com" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">¡Clic aquí para ingresar!</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
Consulta nuestras&nbsp;<a href="http://www.unifyandina.com/Cliente/politicas" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #ffffff;font-weight: normal;text-decoration: underline;">Política Tratamiento de Datos Personales</a>
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

            $this->load->library('email','MY_email');
            $this->email->from('hola@unifyandina.com', 'Unify Andina');
            //$this->email->to('dalaven1996@yahoo.com');
            $this->email->to('juan.gomez@unify.com');
            $this->email->cc('jagomezrueda@gmail.com');
            $this->email->bcc('hola@unifyandina.com');
            $this->email->bcc('o@quevisiongrafica.com');
            $this->email->subject('Trivia de Unify Andina');               
            $this->email->message($mensaje); 
            if (!$this->email->send())
                echo $this->email->print_debugger();
            else echo "1";
        }
    }
    
    
    
    public function cambioPass(){
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
			$this->form_validation->set_rules('password', 'pass0', 'required|callback_checkpass',
                                              array('required'=> 'Ingresa tú contraseña actual'));
            $this->form_validation->set_rules('nueva', 'Nueva', 'required',
                                             array('required'=> 'Ingresa una contraseña'));
			$this->form_validation->set_rules('confirma', 'Confirmacion', 'required|matches[nueva]',
                                              array('matches'=>'Las contraseñas no coinciden.',
                                                    'required'=> 'Repite la contraseña ingresada'));
            
			if($this->form_validation->run() == FALSE){
                $data = array(
                        'password'  => form_error('password',' ',' '),
                        'nueva'     => form_error('nueva',' ',' '),
                        'confirma'  => form_error('confirma',' ',' '),
                    );
                echo json_encode($data);
            }else{               
                $data =array(
                    'documento'=>$this->session->userdata('documento'),
                    'password'=>$this->input->post('nueva'),
                ); 
                if($this->cliente_model->actualizarPassword($data)){
                                            echo json_encode("1");
                }else{
                    echo json_encode("Error al guardar");
                }
            }
		}//else         redirect(base_url(),'refresh');	
	}    
    
    public function checkpass($str){
        $check=$this->cliente_model->buscarPassword($this->session->userdata('documento'));
        if(!empty($str)){
            if($str === $check->password){
                
                return TRUE;
            }else{
                $this->form_validation->set_message('checkpass', 'Contraseña incorrecta');
                return FALSE;            
            }
        }else{
            return TRUE;
        }
    }
    
    public function token(){
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}    
	
    public function session_Update(){
        $data=$this->session->userdata('documento');
        $check_user = $this->cliente_model->login_user($data);
        if($check_user == TRUE){              
            $data = array(
                            'id_usuario' => $check_user->Cedula,
                            'perfil'     => $check_user->idTipo_usuario,
                            'username'   => $check_user->Nombre,
                            'id_empresa' => $check_user->idEmpresas,
                            'cargo' => $check_user->cargo,
                            'documento' => $check_user->Cedula,
                            'telefono'     => $check_user->Celular,
                            'foto'          => $check_user->idFotos,
                            'password'      => $check_user->password,
            );      
            $this->session->set_userdata($data);
        }return;
    }
}
