<?php

class ControllerTask extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelTask', 'ModelValidateTask'];
    protected $components = ['Auth', 'Values'];
    protected $actionsRequireLogin = ['Edit', 'Delete'];

    public function actionIndex($param)
    {   
        $numberOfRecords = $this->ModelTask->getCountFromTable();
        $selectedData['tasks'] = $this->ModelTask->selectDataForMainPage($param, $numberOfRecords);
        $selectedData['sorting'] = $this->ModelTask->getParamsSorting();
        $selectedData['pagination'] = $this->ModelTask->getParamsPagination();
        return $selectedData;
    }

    public function actionDelete($param)
    {   
        if (!isset($param)) {
            throw new CoreExceptionHandler();
        } else {
            $isDeleted = $this->ModelTask->deleteTask($param[2]);
            $this->ModelTask->isDeleted($isDeleted);
        }
    }

    public function actionAdd()
    {
        $data = [];
        if ($_POST) {    
           $data = $this->addRecord();
        }
        return $data;
    }

    public function actionDone($param)
    {   
        if (!isset($param)) {
            throw new CoreExceptionHandler();
        } else {
            $isDone = $this->ModelTask->taskIsDone($param[2]); 
        }
    }

    public function actionEdit($param)
    {  
        $inputValues = $this->getValuesForUpdate($param[2]);
        $formData['data'] = $inputValues;
        $formData['validate'] = '';
        
        if ($_POST) {    
           $formData = $this->editRecord($param[2]);
        }
        return $formData;
    }

    private function getValuesForUpdate($recordID)
    {
        $selectedData = $this->ModelTask->selectNeededTask($recordID);
        $data = $this->ModelTask->getDataForEdit($selectedData);
        return $data;
    }

    private function addRecord()
    {  
        $formData = [];
        $results = false;
        $inputValues = $this->getInputValues($this->fieldsStructure['taskAdd']);
        //Validate InputValues
        $validateList = $this->ModelValidateTask->validateData($inputValues);

        //change name
        $newFileName = $this->getNewFileName($inputValues); 

        //insert Data
        $noEmptyValidateList = array_diff($validateList, array(''));
        if (empty($noEmptyValidateList)) {
            //upload File
            $fileDestination = 'img/' . $newFileName;
            move_uploaded_file($inputValues['todo_img']['tmp_name'], $fileDestination);
            //insert data
            unset($inputValues['todo_img']);
            $results = $this->ModelTask->insertDataToTable($inputValues, $newFileName);
        } else {
            $formData['data'] = $inputValues;
            $formData['validate'] = $validateList;
        }

        $this->ModelTask->createMsgAboutResult($results, 'insert');
        return $formData;
    }

    private function editRecord($param)
    {
        $formData = [];
        $results = false;
        $inputValues = $this->getInputValues($this->fieldsStructure['taskAdd']);
        //Validate InputValues
        $validateList = $this->ModelValidateTask->validateData($inputValues);

        //change name
        $newFileName = $this->getNewFileName($inputValues); 

        //insert Data
        $noEmptyValidateList = array_diff($validateList, array(''));
        if (empty($noEmptyValidateList)) {
            //upload File
            $fileDestination = 'img/' . $newFileName;
            move_uploaded_file($inputValues['todo_img']['tmp_name'], $fileDestination);
            //insert data
            unset($inputValues['todo_img']);
            $results = $this->ModelTask->updateDataToTable($inputValues, $param, $newFileName);
        } else {
            $formData['data'] = $inputValues;
            $formData['validate'] = $validateList;
        }

        $this->ModelTask->createMsgAboutResult($results, 'update');
        return $formData;
    }

    private function getNewFileName($inputValues)
    {
        //change name
        if ($inputValues['todo_img']['name'] !== '') {
            $fileExtension = explode('.', $inputValues['todo_img']['name']);
            $fileActualExt = strtolower(end($fileExtension));
            $newFileName = uniqid('img_', true) . '.' . $fileActualExt; 
            return $newFileName;
        }
    }

}
