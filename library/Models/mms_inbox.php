<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tmms_inbox extends dao_mysql
{
    public $__table = 'mms_inbox';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $masmmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_masmmsid='mms_inbox.masmmsid';
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
    public $_extcode='mms_inbox.extcode';
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
    public $_sourceaddr='mms_inbox.sourceaddr';
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
    public $_receivetime='mms_inbox.receivetime';
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $subject;
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $_subject='mms_inbox.subject';
    /**
     * 注释:
     *
     * @var blob
     */
    public $messagecontent;
    /**
     * 注释:
     *
     * @var blob
     */
    public $_messagecontent='mms_inbox.messagecontent';
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
    public $_requesttime='mms_inbox.requesttime';
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
    public $_applicationid='mms_inbox.applicationid';
}
