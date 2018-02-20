<?php

class ModelTask extends CoreModel
{
    protected $components = ['Validate', 'Sorting', 'Pagination'];

    protected $sortParams = '';
    protected $paginationParams = '';

    public function getLabelsOfContact()
    {
        return $this->labelsOfContact;
    }

    public function getParamsSorting()
    {
        return $this->sortParams;
    }

    public function getParamsPagination()
    {
        return $this->paginationParams;
    }

    private function getUserID()
    {    
        try {
            $session = new ModelSessions;
            return $session->getUserID();
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n"; //TODO
        }
    }

    public function selectDataForMainPage($param, $numberOfRecords)
    {
        $sortParams = $this->getSortParams($param);
        $limit = $this->Pagination->getLimitParams($param, $numberOfRecords);
        $this->paginationParams = $limit;
        $userId = $this->getUserID();

        $selectQuery = "SELECT * FROM todoList
                            ORDER BY " . $sortParams['column'] . ' ' . $sortParams['sort'] . "
                                LIMIT " . $limit['pageFirstResult'] . ',' . $limit['resultsPerPage'] . "";

        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        $this->sortParams['sort'] = $this->Sorting->changeSortBy($param);
        return $resultSelect;
    }

    private function getSortParams($param)
    {
        $sortColumns = include('Config/sortColumns.php');

        $sortParams['column'] = $this->Sorting->getColumn($param, array_keys($sortColumns));
        $sortParams['sort'] = $this->Sorting->getSortBy($param); //TODO
        //$this->Sorting->changeSortBy($param);
        $this->sortParams = $sortParams;
        return $sortParams;
    }

    public function deleteTask($idLine)
    {
        $forEscape['idLine'] = $idLine;
        $escapedData = CoreDB::getInstance()->escapeData($forEscape);
        $userId = $this->getUserID();
        return CoreDB::getInstance()->delete("DELETE FROM todoList WHERE todoID = '" . $escapedData['idLine'] . "'");
    }

    public function isDeleted($statement)
    {
        $session = new ModelSessions;
        if ($statement === true) {
            $msg['deleted'] = true;
            $session->recordMessageInSession('delete', $msg);
        } else {
            $msg['notDelete'] = true;
            $session->recordMessageInSession('delete', $msg);
        }
        $uri = include('Config/defController.php');
        header("Location: /" . $uri['controller'] . '/' . $uri['action']);
    }

    public function taskIsDone($idLine)
    {
        $forEscape['idLine'] = $idLine;
        $escapedData = CoreDB::getInstance()->escapeData($forEscape);
        $userId = $this->getUserID();
        CoreDB::getInstance()->delete("UPDATE todoList SET todoList.todoStatus = true 
                                                WHERE todoList.todoID   = '" . $escapedData['idLine'] . "'");

        $uri = include('Config/defController.php');
        header("Location: /" . $uri['controller'] . '/' . $uri['action']);
    }

    public function insertDataToTable($data, $fileName)
    {
        $data = CoreDB::getInstance()->escapeData($data);
        $insertQuery = "INSERT INTO todoList (userName, userEmail, todoText, todoImg, todoStatus) VALUES (
            '" . $data['user_name'] . "',
            '" . $data['user_email'] . "',
            '" . $data['todo_Text'] . "',
            '" . $fileName . "',
            false
        )";
        $resultInsert = CoreDB::getInstance()->insertToDB($insertQuery);
        return $resultInsert;
    }

    public function isInserted($statement)
    {
        $session = new ModelSessions;
        if ($statement === true) {
            $msg['add'] = true;
            $session->recordMessageInSession('insert', $msg);
            header("Location: /contact/index");
        } else {
            $msg['notAdd'] = true;
            $session->recordMessageInSession('insert', $msg);
        }
    }

    public function selectNeededTask($idLine)
    {
        $forEscape['idLine'] = $idLine;
        $escapedData = CoreDB::getInstance()->escapeData($forEscape);

        $userId = $this->getUserID();
        $selectQuery = "SELECT * FROM todoList WHERE todoList.todoID = '" . $escapedData['idLine'] . "'";

        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function updateDataToTable($data, $taskID, $fileName)
    {
        $forEscape['idLine'] = $taskID;
        $taskID = CoreDB::getInstance()->escapeData($forEscape);
        $data = CoreDB::getInstance()->escapeData($data);
        $userId = $this->getUserID();

        $issetImg = $this->issetImg($taskID['idLine']);
        if ($issetImg == true) {
            $updateQuery = "UPDATE todoList 
                SET userName  = '" . $data['user_name'] . "',
                    userEmail = '" . $data['user_email'] . "',
                    todoText  = '" . $data['todo_Text'] . "' WHERE todoList.todoID   = '" . $taskID['idLine'] . "'";
        } else {
            $updateQuery = "UPDATE todoList 
                SET userName  = '" . $data['user_name'] . "',
                    userEmail = '" . $data['user_email'] . "',
                    todoText  = '" . $data['todo_Text'] . "',
                    todoImg   = '" . $fileName . "' WHERE todoList.todoID   = '" . $taskID['idLine'] . "'";
        }

        $resultUpdate = CoreDB::getInstance()->updateDB($updateQuery);
        return $resultUpdate;
    }

    private function issetImg($taskID)
    {
        $selectQuery = "SELECT todoList.todoImg FROM todoList WHERE todoList.todoID = '" . $taskID . "'";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        if ($resultSelect !== false) {
            if ($resultSelect[0]['todoImg'] == '') {
                return false;
            }
        }
        return true;
    }

    public function getDataForEdit($selectedData)
    {
        foreach ($selectedData as $key => $value) {
            $dataForEdit = [
                'user_name'  => $value['userName'],
                'user_email' => $value['userEmail'],
                'todo_Text'  => $value['todoText'],
                'todo_img'   => $value['todoImg']
            ];
        }
        return $dataForEdit;
    }

    public function getCountFromTable()
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT COUNT(todoList.todoID) AS amt 
                        FROM todoList";

        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function createMsgAboutResult($statement, $from)
    {
        $session = new ModelSessions;
        if ($statement === true) {
            $msg['add'] = true;
            $session->recordMessageInSession($from, $msg);
            $uri = include('Config/defController.php');
            header("Location: /" . $uri['controller'] . '/' . $uri['action']);
        } else {
            $msg['notAdd'] = true;
            $session->recordMessageInSession($from, $msg);
        }
    }
}
