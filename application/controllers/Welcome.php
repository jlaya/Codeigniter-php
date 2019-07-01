<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	

	public function index()
	{
		$ci = &get_instance();
		$ci->load->library('email');
		$this->load->library('parser');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "jesusgerard2008@gmail.com"; 
		$config['smtp_pass'] = "macumbasyara";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);

		$ci->email->from($config['smtp_user'], 'Prueba de envio de correo a jesus laya');
		$list = array($config['smtp_user']);
		$ci->email->to($list);
		//$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
		$ci->email->subject('Envio exitoso local');
		$title = "Titulo prueba";
		$content = "Texto enriquecido de texto para su descripcion";
		$data = compact("title","content");
		$bodyMail = $this->parser->parse('mails/send_license', $data, true);
		$ci->email->message($bodyMail);
		$ci->email->send();

	}
}
