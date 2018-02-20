<?php

class ControllerUser extends CoreController
{
    protected $models = ['ModelSessions', 'ModelUser', 'ModelValidateUser'];
    protected $components = ['Auth'];
    protected $actionsRequireLogin = [];

    public function actionLogin()
    {
        if ($_POST) {
            $this->authentication();
        }
        if ($this->ModelSessions->issetLogin() == true) {
            $this->locationMainPage();
        }
        return null;
    }

    public function actionRegister()
    {
        $formData = [];
        if ($_POST) {
            $formData = $this->registration();
        }

        if ($this->ModelSessions->issetLogin() == true) {
            $this->locationMainPage();
        }
        return $formData;
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: /user/login");
    }

    public function locationMainPage()
    {
        $uri = include('Config/defController.php');
        header("Location: /" . $uri['controller'] . '/' . $uri['action']);
    }

    private function authentication()
    {
        $auth = $this->Auth->auth($_POST['user_login'], $_POST['user_pass']);
        if ($auth['is_auth'] === true) {
            $this->ModelSessions->authenticationToSession($auth['user']['userID'], $auth['user']['login']);
        } else {
            $this->ModelSessions->recordMessageInSession('auth', $auth);
        }
    }

    private function registration()
    {
        $inputValues = $this->getInputValues($this->fieldsStructure['register']);
        $validateList = $this->ModelValidateUser->validateData($inputValues);
        $noEmptyValidateList = array_diff($validateList, array(''));
        if (empty($noEmptyValidateList)) {
            try {
                $result = $this->register($inputValues);
                $this->ModelSessions->recordMessageInSession('register', $result);
                return $formData['data'] = $inputValues;
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";//TODO
            }
        } else {
            $formData['data'] = $inputValues;
            $formData['validate'] = $validateList;
        }
        return $formData;
    }

    public function register($values)
    {   
        $msg = [];
        $values['user_pass'] = md5(trim($values['user_pass']));
        $ModelValidateUser = new ModelValidateUser;
        $isBusyLogin = $this->ModelValidateUser->isBusyLogin($values['user_login']);
        if ($isBusyLogin === true) {
            $msg['busyLogin'] = true;
        } elseif ($isBusyLogin === false) {
            //$values['user_role'] = 1; //TODO
            $msg['registered'] = $this->ModelUser->insertUserIntoDB($values);
        } else {
            throw new Exception('Error: User data has not been added');
        }
        return $msg;
    }
}
