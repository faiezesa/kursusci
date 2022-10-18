<?php
namespace App\Controllers;
use App\Controllers\BaseController;

/**
 * Class Simple LDAP Auth
 * @package App\Controllers
 * @author Eimiza Faisha Azmi <eimizafaisha@gmail.com>
 */

class Auth extends BaseController{

    public function __construct(){
        /**
         * If Already declared Session in BaseController,
         * then comment the below declaration
         */
        $this->session = \Config\Services::session();
    }

    /*public function login(){
        $this->render_login();
        //return view('auth/login');
    }*/

    public function ldap_auth(){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $ldap_dn = "uid=".$username.",dc=example,dc=com";
            $ldap_password = $password;
            $ldap_con = ldap_connect("ldap.forumsys.com");
            ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
            if(@$ldapbind = ldap_bind($ldap_con,$ldap_dn,$ldap_password)){
                $result = ldap_search($ldap_con, "dc=example,dc=com", "(uid=$username)");
                if (FALSE !== $result){
                    $entries = ldap_get_entries($ldap_con, $result);
                    $this->set_session($entries[0]);
                    
                }
                return redirect()->to('/dashboard');
                
            }else{
                echo "Invalid Credential";
                return redirect()->to('/');
            }
        
     }

     public function set_session($data){
        $array = [
            'user'  => $data['uid'][0],
            'name'  => $data['cn'][0],
            'email'     => $data['mail'][0],
            'logged_in' => true,
        ];
        $this->session->set($array);
     }

     public function logout()
     {
         $this->session->destroy();
         return redirect()->to('/');
     }

}
