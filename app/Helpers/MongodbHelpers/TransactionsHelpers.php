<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers\MongodbHelpers;

/**
 * Description of TransactionsHelpers
 *
 * @author moataz
 */
class TransactionsHelpers {

    private $tableName;

    const INSERT = array(
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'insert',
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    );
    const UPDATE = [
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'update',
        'dataBefore' => [],
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    ];
    const DELETE = [
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'delete',
        'dataBefore' => [],
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    ];

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    public function propertiesUpdateOrDelete($model, &$body, $entityId) {
        $data = $model->toArray();
        foreach ($data as $key => $value) {
            if ($model->isDirty($key)) {
                $body ['changedProperties'][] = $key;
            }
            $body ['dataBefore'][$key] = $model->getOriginal($key);
        }
        $body ['dataAfter'] = $data;
        $body ['tableName'] = $this->tableName;
        $body ['creationTime'] = date('Y-m-d H:i:s');
        $body ['entityId'] = $entityId;
    }

    public function propertiesInsert($model, &$body, $entityId) {
        $data = $model->toArray();
        foreach ($data as $key => $value) {
            $body ['changedProperties'][] = $key;
        }
        $body ['dataAfter'] = $data;
        $body ['tableName'] = $this->tableName;
        $body ['creationTime'] = date('Y-m-d H:i:s');
        $body ['entityId'] = $entityId;
    }
    
    public function createInMongo($transactionRepository, $data) {
        $transactionObject = $transactionRepository->findByAttribute(['tableName' => $data['tableName'], 'entityId' => $data['entityId']
            , 'transactionType' => $data['transactionType'], 'dataAfter' => $data['dataAfter'], 'recordId' => $data['recordId']]);
        if (!$transactionObject) {
            $transactionRepository->create($data);
        }
    }

}
