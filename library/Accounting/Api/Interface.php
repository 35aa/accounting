<?
//all methods for api should inherite this interface to prevent
//strange situations in the future when this interface will e changed but 
//but some class will not use common schema and thus appeared critical issue
//and systemm will be unstable
interface Accounting_Api_Interface {
  public function checkAuth();
  public function setRequestData(array $data);
  public function validateInputData();
  public function processRequest();
  public function getResponseData();
  public function getJsonResponseData();
  public function isError();
  public function getErrors();
  public function getJsonErorrs();
}
