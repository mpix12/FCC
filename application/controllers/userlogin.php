<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class UserLogin extends CI_Controller
{
    public $footer;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');

        $isLoggedIn = $this->session->userdata('user-login');
        
        if(isset($isLoggedIn) && $isLoggedIn == TRUE)
        {
            redirect('/home');
        }

        $this->load->model('captcha_model');
        $this->load->model('menu_model');
        $this->currentMenus = $this->menu_model->getCurrentMenus();

        $this->load->model('social_model');
        $this->socials = $this->social_model->getSocials();

        $this->load->model('coinlist_model');
        $this->load->model('actionlist_model');
        $this->load->model("broadcast_model");
        $this->load->model('footer_model');     
        $this->footer = $this->footer_model->getCurrentFooter();
        $this->load->model("email_model");
        
    }

    public function index(){
    	$data['title'] = 'FCC | Login';
        $data['menus'] = $this->currentMenus;
        $data['socials'] = $this->socials;
        $data['broadcasts'] = $this->broadcast_model->getCurrentBroadcast();
        $data['footer'] = $this->footer;
       
    	$this->load->view('home/header', $data);
    	$this->load->view('user/login', $data);
    	$this->load->view('home/footer', $data);
    }

    public function forgotpassword(){
    	$data['title'] = 'FCC | ForgotPassword';
        $data['broadcasts'] = $this->broadcast_model->getCurrentBroadcast();
        $data['footer'] = $this->footer;
          $data['menus'] = $this->currentMenus;
        $data['socials'] = $this->socials;

    	$this->load->view('home/header', $data);
    	$this->load->view('user/forgotpassword');
    	$this->load->view('home/footer');
    }

    public function signup(){
    	$data['title'] = 'FCC | Signup';
        $data['menus'] = $this->currentMenus;
        $data['socials'] = $this->socials;
        $data['broadcasts'] = $this->broadcast_model->getCurrentBroadcast();
        $data['footer'] = $this->footer;

    	$this->load->view('home/header', $data);
    	$this->load->view('user/signup');
    	$this->load->view('home/footer', $data);
    }

    // backend

    public function b_signin() {
        $this->load->library('form_validation');    
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');

        $recaptcha = $this->input->post('captcha');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if (isset($response['success']) and $response['success'] === true) {
          $this->captcha_model->addNewCaptcha();
        } else {
            $return_data['code'] = 'error';
            $return_data['message'] = $response['error-codes'];
            echo json_encode($return_data);
            exit();
        }
         
        $return_data = array();
        if($this->form_validation->run() == FALSE)
        {
            $return_data['code'] = 'error';
            $return_data['message'] = 'Please all data correctly!';
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->login_model->loginMe($email, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {   
                    $user_email = $res->email;
                    $email_explods = explode("@", $user_email);
                    $user_session = array(
                        'user-id'=>$res->userId,
                        'user-login'=> true,
                        'user-name' => $res->name == "" ? $email_explods[0]: $res->name,
                        'user-email' => $user_email
                    );
                                    
                    $this->session->set_userdata($user_session);
                    
                    $return_data['code'] = 'success';
                    $return_data['message'] = 'Signin is successed!';
                    echo json_encode($return_data);
                    exit();
                    
                }
            }
            else
            {   
                $return_data['code'] = 'error';
                $return_data['message'] = 'Email or password mismatch';
                echo json_encode($return_data);
                exit();
            }
                        
        }
        
    }

    public function b_signup() {

        $this->load->library('form_validation');    
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');

        $return_data = array();   

        $recaptcha = $this->input->post('token');
        $response = $this->recaptcha->verifyResponseInvisible($recaptcha);

        if (isset($response['success']) and $response['success'] === true) {
          $this->captcha_model->addNewCaptcha();
        } else {
            $return_data['code'] = 'error';
            $return_data['message'] =  $response['error-codes'];
            echo json_encode($return_data);
            exit();   
        }

        if($this->form_validation->run() == FALSE)
        {
            $return_data['code'] = 'error';
            $return_data['message'] = 'Please all data correctly!';

            echo json_encode($return_data);
            exit();   
        }
        else
        {
        	$email = $this->input->post('email');
            $password = $this->input->post('password');

            $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>3, 'name'=> '' , 'createdBy'=>-1, 'createdDtm'=>date('Y-m-d H:i:s'));
                    
            

            $users = $this->user_model->usersByEmail($email);
            if(count($users) > 0) {
                $return_data['code'] = 'error';
                $return_data['message'] = 'User is already exist!';
                echo json_encode($return_data);
                exit();        
            }
            
            $result = $this->user_model->addNewUser($userInfo);
            
            if($result > 0) {
                $return_data['code'] = 'success';
                $return_data['message'] = 'Signup is successed!';
                $this->email_model->sendEmail($email, 'signup');

                echo json_encode($return_data);
                exit();
            }else{
                $return_data['code'] = 'error';
                $return_data['message'] = 'Database transaction is faild!';
                echo json_encode($return_data);
                exit();
            }
        }
        echo json_encode($return_data);
    }


}