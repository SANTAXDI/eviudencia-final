<?php

namespace App;

/**
 * Clase Estandar de Respuestas en general del API 
 */
class Result 
{

	const RESULT_TYPE_SUCCESS 	= 'success';
	const RESULT_TYPE_ERROR 	= 'error';

	protected $type 	= null;
	protected $message	= null;
	protected $data		= null;
    
    public function __construct()
    {
        $this->setTypeSuccess()
             ->setMessage('Success');
    }


    public function getType(): string
    {
    	return $this->type;
    }

    public function setTypeSuccess()
    {
    	$this->type = self::RESULT_TYPE_SUCCESS;
    	return $this;	
    }

    public function setTypeError()
    {
    	$this->type = self::RESULT_TYPE_ERROR;
    	return $this;	
    }

    public function getMessage()
    {
    	return $this->message;
    }

    public function setMessage(string $message)
    {
    	$this->message = $message;
    	return $this;
    }

    public function getData()
    {
    	return $this->data;
    }

    public function setData(?array $data)
    {
    	$this->data = $data;
    	return $this;
    }

    public static function error(string $message = 'Error', array $data = null)
    {
    	$result = new self();
    	$result->setTypeError()
    		   ->setmessage($message)
    		   ->setData($data);
    	return [
                'type' => $result->getType(),
                'message' => $result->getMessage(),
                'data' => $result->getData()
            ];
    }

	public static function success(array $data = null, string $message = 'Success')
    {
    	$result = new self();
    	$result->setTypeSuccess()
    		   ->setmessage($message)
    		   ->setData($data);
    	return [
                'type' => $result->getType(),
                'message' => $result->getMessage(),
                'data' => $result->getData()
            ];
    }    

}
