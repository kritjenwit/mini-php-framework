<?php

class Output
{

   /** @var string $message  */
   private $message;

   /** @var string $status */
   private $status;

   /** @var number $total */
   private $total;

   /** @var array $data */
   private $data;

   /**
    * Send function
    *
    *
    * To set data to be send
    *
    * @param   array    $data    Data to be send 
    * @return  object   $this    return itself
    */
   public function send($data = NULL)
   {
      $this->__set('data',[$data]);
      return $this;
   }
   /**
    * 
    */
   public function as_success($message = NULL)
   {
      $this->__set('status',count($this->__get('data')) > 0 ? '101' : '200')->__set('message',$message)->__set('total',count($this->__get('data')));
      return $this->return_data();
   }

   public function as_error($status = '400',$message = 'Bad request')
   {
      $this->__set('status',$status)->__set('message',$message)->__set('total',$this->__get('data') === NULL ? 0 : count($this->__get('data')));
      return $this->return_data();
   }

   private function return_data()
   {
      return to_json(
         [
            'status' => $this->__get('status'),
            'data' => $this->__get('data'),
            'message' => $this->__get('message'),
            'total' => $this->__get('total')
         ]
      );
   }

   public function __set($property, $value) {
      if (property_exists($this, $property)) {
         $this->$property = $value;
      }
      return $this;
   }

   public function __get($property) {
      if (property_exists($this, $property)) {
        return $this->$property;
      }
    }
}

$output = new Output;




// public function send($status_code,$data,$message = NULL)
   // {
   //    return 
   //       [
   //          'status' => $status_code,
   //          'data' => $data,
   //          'message' => $message,
   //          'total' => count($data)
   //       ];
   // }