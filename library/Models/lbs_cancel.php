<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tlbs_cancel extends dao_mysql
{
    public $__table = 'lbs_cancel';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $silbsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_silbsid='lbs_cancel.silbsid';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $requesttime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_requesttime='lbs_cancel.requesttime';
    /**
     * 注释:
     *
     * @var varchar(16)
     */
    public $applicationid;
    /**
     * 注释:
     *
     * @var varchar(16)
     */
    public $_applicationid='lbs_cancel.applicationid';
}
