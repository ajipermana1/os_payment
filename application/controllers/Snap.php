<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Snap extends CI_Controller
{

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-ZYkELfar9ggUTlXq6422JO3z', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$name = $this->input->post('name');
		$kelas = $this->input->post('kelas');
		$nisn = $this->input->post('nisn');
		$nama = $this->input->post('nama');
		$bsr_iuran = $this->input->post('bsr_iuran');
		$email = $this->input->post('email');



		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $bsr_iuran, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => 'a1',
			'price' => $bsr_iuran,
			'quantity' => 1,
			'name' => $nama . ' Kelas ' . $kelas
		);

		// // Optional
		// $item2_details = array(
		// 	'id' => 'a2',
		// 	'price' => 20000,
		// 	'quantity' => 2,
		// 	'name' => "Orange"
		// );

		// Optional
		$item_details = array($item1_details);

		// Optional
		// $billing_address = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'address'       => "Mangga 20",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16602",
		// 	'phone'         => "081122334455",
		// 	'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		// 	'first_name'    => "Obet",
		// 	'last_name'     => "Supriadi",
		// 	'address'       => "Manggis 90",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16601",
		// 	'phone'         => "08113366345",
		// 	'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
			'first_name'    => $name,
			'email'         => $email,


		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'day',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish($id)
	{
		$result = json_decode($this->input->post('result_data'), true);
		$data = [
			'order_id' => $result['order_id'],
			'nisn' => $this->input->post('nisn'),
			'name' => $this->input->post('name'),
			'kelas' => $this->input->post('kelas'),
			'nama' => $this->input->post('nama'),
			'gross_amount' => $result['gross_amount'],
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
			'bank' => $result['va_numbers'][0]['bank'],
			'va_number' => $result['va_numbers'][0]['va_number'],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code']


		];
		
		$dk = [
		    'order_id' => $result['order_id']
		    ];
		$userdata = $this->session->userdata('email');
		$this->db->update('kartu_spp',$dk,['id' => $id]);
		$bayar = $this->db->insert('transaksi_midtrans', $data);
		if ($bayar) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary text-center" role="alert">
			Silahkan selesaikan pembayaran.
				</div>');
			redirect('user/sp_card');
		}
	}
}
