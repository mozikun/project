<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tsms_inbox extends dao_mysql
{
    public $__table = 'sms_inbox';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $massmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_massmsid='sms_inbox.massmsid';
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $extcode;
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $_extcode='sms_inbox.extcode';
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $sourceaddr;
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $_sourceaddr='sms_inbox.sourceaddr';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $receivetime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_receivetime='sms_inbox.receivetime';
    /**
     * 注释:
     *
     * @var varchar(400)
     */
    public $messagecontent;
    /**
     * 注释:
     *
     * @var varchar(400)
     */
    public $_messagecontent='sms_inbox.messagecontent';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $msgfmt;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_msgfmt='sms_inbox.msgfmt';
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
    public $_requesttime='sms_inbox.requesttime';
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
    public $_applicationid='sms_inbox.applicationid';
}
