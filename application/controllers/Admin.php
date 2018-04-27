<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
                $this->load->model(array('admin_model','cliente_model'));
                $this->load->library(array('session','form_validation'));
                $this->load->helper(array('url','form'));
	}
    
	public function index()	{
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            redirect(base_url());
        $fotos=$this->admin_model->load_Foto($this->session->userdata('foto'));
        $data['boton']="posiciones";
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $data['ranking']=  $this->admin_model->ranking();
        $this->load->view('Cliente/header',$data);
		$this->load->view('Admin/posiciones',$data);
        $this->load->view('Cliente/footer.php',$data);
	}
        
    public function aprobar(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            redirect(base_url());
        $fotos=$this->admin_model->load_Foto($this->session->userdata('foto'));
        $data['boton']="aprobar";
        $data['foto_perfil'] = $fotos->Ruta;
        $data['ordenes']=  $this->admin_model->get_OC();
        $data['oportunidades']=  $this->admin_model->get_Oportunidades();
        $data['eventos']=  $this->admin_model->get_Eventos();
        $data['certificados']=  $this->admin_model->get_Certificados();
        $this->load->view('Cliente/header',$data);
        $this->load->view('Admin/botonera',$data);
        $this->load->view('Admin/aprobaciones',$data);
        
    }
    
    public function perfil(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1'){
			redirect(base_url());
		}
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['boton']="perfil";
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Admin/perfil',$data);
        $this->load->view('Cliente/footer.php',$data);
    }
    
    public function password(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1'){
			redirect(base_url());
		}
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $data['boton']="perfil";
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Admin/botonera.php',$data);
        $this->load->view('Admin/cambiopass',$data);
        $this->load->view('Cliente/footer.php',$data);
    }
    
	public function settings(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1'){
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
        $this->load->view('Admin/botonera.php',$data);
		$this->load->view('Admin/actualizardatos.php',$data);
    }
    
    public function politicas(){
         if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Admin/botonera.php',$data);
		$this->load->view('Cliente/politicas-de-datos.php');
    }
    
    public function faq(){
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1'){
			redirect(base_url());
		}
        $data['boton']="perfil";
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        $data['token'] = $this->token();
        $this->load->view('Cliente/header.php',$data);
        $this->load->view('Admin/botonera.php',$data);
		$this->load->view('Admin/faq.php');
        $this->load->view('Cliente/footer.php',$data);
        
    }
    
    public function exito(){
        $a=  $this->uri->segment(3);
        $data['token'] = $this->token();
        $fotos=$this->cliente_model->load_Foto($this->session->userdata('foto'));
        $data['foto_perfil'] = $fotos->Ruta;
        if($a == 1){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Admin/botonera.php',$data);
		    $this->load->view('Cliente/exitomail.php');
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 2){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Admin/botonera.php',$data);
            $this->load->view('Cliente/exitopass',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 3){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Admin/botonera.php',$data);
            $this->load->view('Cliente/exitosend.php',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
        if($a == 4){
            $this->load->view('Cliente/header.php',$data);
            $this->load->view('Admin/botonera.php',$data);
            $this->load->view('Admin/exitoupdate',$data);
            $this->load->view('Cliente/footer.php',$data);
        }
    } 

    
    
    //FIN DE VISTAS
  public function Reporte(){
           $nombre_archivo = 'Reporte_App_Unify_Andina_'.date('d-m-Y').'.csv';  
            $sCSV           = $this->admin_model->get_datos_tabla();
                       
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            echo $sCSV;
  }

      public function Reporte_OC(){
           $nombre_archivo = 'Reporte_App_Unify_Andina_OC'.date('d-m-Y').'.csv';  
            $sCSV           = $this->admin_model->get_datos_OC();
                       
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            echo $sCSV;
  }

      public function Reporte_LEAD(){
           $nombre_archivo = 'Reporte_App_Unify_Andina_LEADS'.date('d-m-Y').'.csv';  
            $sCSV           = $this->admin_model->get_datos_LEADS();
                       
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            echo $sCSV;
  }

      public function Reporte_EVENTO(){
           $nombre_archivo = 'Reporte_App_Unify_Andina_EVENTOS'.date('d-m-Y').'.csv';  
            $sCSV           = $this->admin_model->get_datos_EVENTO();
                       
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            echo $sCSV;
  }

      public function Reporte_CERTI(){
           $nombre_archivo = 'Reporte_App_Unify_Andina_CERTI'.date('d-m-Y').'.csv';  
            $sCSV           = $this->admin_model->get_datos_CERTI();
                       
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            echo $sCSV;
  }

    
    
    public function aceptar(){

        $data['id']=$_POST["id"];
        $data['tipo']=$_POST["tipo"];
        $data['cedula']=$_POST["cedula"];
        $data['Nombre']=$_POST["nombre"];
        $data['check']="Aprobada";
        $this->admin_model->ActualizarCheck($data,1);
        $this->admin_model->Suma_monto($data);
        echo $this->notificacion($data);
        //echo $data['id']." ".$data['tipo']." ".$data['cedula']." ".$data['Nombre'];

        //$this->enviarnotificacion($datos->Nombre,$datos->Email);
        //echo $datos->Nombre.$datos->Email;
        //$tiempo_fin = microtime(true);
    }
    
    public function denegar(){
        $data['id']=$_POST["id"];
        $data['tipo']=$_POST["tipo"];
        $data['cedula']=$_POST["cedula"];
        $data['Nombre']=$_POST["nombre"];
        $data['check']="Rechazada";
        $this->admin_model->ActualizarCheck($data,2);
        echo $this->notificacion($data);
     }
    
    
    
    public function notificacion($data){
        if($data['tipo']== "1"){
            $mensaje= "- Orden de compra: ".$data['Nombre']." ".$data['check'];
            $asunto = "OC ".$data['Nombre'];
        }
        if($data['tipo']== "2"){
            $mensaje="- Oportunidad: ".$data['Nombre']." ".$data['check'];
            $asunto = "Lead ".$data['Nombre'];
        }
        if($data['tipo']== "3"){
            $mensaje="- Evento: ".$data['Nombre']." ".$data['check'];
            $asunto = "Asistencia a ".$data['Nombre'];
        }
        if($data['tipo']== "4"){
            $mensaje="- Certificación: ".$data['Nombre']." ".$data['check'];
            $asunto = "Certificado ".$data['Nombre'];
        }
        $a=$this->admin_model->recover_name($data['cedula']);
        $email=$a->Email;
        $usuario=$a->Nombre;
    
        
        $mensaje=$this->mailnotificacion($mensaje,$usuario);
        $this->load->library('email','MY_email');
        $this->email->from('hola@unifyandina.com', 'Arturo de Unify Andina');
        $this->email->to($email);
        
            $this->email->bcc('hola@unifyandina.com');
            $this->email->bcc('o@quevisiongrafica.com');
        $this->email->subject('Tu '.$asunto.' ha sido '.$data['check']);               
        $this->email->message($mensaje); 
        if (!$this->email->send())
            return $this->email->print_debugger();
        else return "1";
    }
    
    public function mailnotificacion($Mensaje,$nombre){ 
       return ' <!doctype html>
                <html lang="es" xmlns:og="http://opengraph.org/schema/">
        <head>
		<meta property="og:title" content="Estado de tu información registrada."/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />        
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estado de tu información registrada.</title>
        <style type="text/css">
            p{                margin:10px 0;                padding:0;            }
            table{                border-collapse:collapse;            }
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
            #outlook a{                padding:0;}
            img{                -ms-interpolation-mode:bicubic;            }
            table{
                mso-table-lspace:0pt;
                mso-table-rspace:0pt;
            }
            .ReadMsgBody{                width:100%;           }
            .ExternalClass{                width:100%;            }
            p,a,li,td,blockquote{                mso-line-height-rule:exactly;            }
            a[href^=tel],a[href^=sms]{
                color:inherit;
                cursor:default;
                text-decoration:none;
            }
            p,a,li,td,body,table,blockquote{
                -ms-text-size-adjust:100%;
                -webkit-text-size-adjust:100%;
            }
            .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{                line-height:100%;            }
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
<span style="font-size:32px"><span style="color:#88C540"><strong>Hola, '.$nombre.'!</strong></span></span>
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
                        
                            Hemos verificado la información que has registrado en Unify 17. Aquí tienes un resumen del estado de estos registros:
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
                        
'.$Mensaje.'<br>
En caso de que alguno de estos registros no fuera aprobado comunícate con tu Cam para mayor información.<br>
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
                        
                            Ahora puedes ver tus registros actualizados en la plataforma.<br>
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
                                <a class="mcnButton " title="¡Verifica aquí tu progreso!" href="http://www.unifyandina.com" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">¡Verifica aquí tu progreso!</a>
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
                        
                            <div style="text-align: center;">O copia y pega este enlace en tu navegador:<br>
http://www.unifyandina.com</div>
<br>
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
                        
                            <span style="font-size:20px">unifyandina.com</span><br>
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
</html>';
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