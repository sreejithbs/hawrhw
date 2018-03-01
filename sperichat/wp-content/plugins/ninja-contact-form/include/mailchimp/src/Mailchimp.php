<?php

if (class_exists('LA_Mailchimp_Folders') != true) require_once 'Mailchimp/Folders.php';
if (class_exists('LA_Mailchimp_Templates') != true) require_once 'Mailchimp/Templates.php';
if (class_exists('LA_Mailchimp_Users') != true) require_once 'Mailchimp/Users.php';
if (class_exists('LA_Mailchimp_Helper') != true) require_once 'Mailchimp/Helper.php';
if (class_exists('LA_Mailchimp_Mobile') != true) require_once 'Mailchimp/Mobile.php';
if (class_exists('LA_Mailchimp_Conversations') != true) require_once 'Mailchimp/Conversations.php';
if (class_exists('LA_Mailchimp_Ecomm') != true) require_once 'Mailchimp/Ecomm.php';
if (class_exists('LA_Mailchimp_Neapolitan') != true) require_once 'Mailchimp/Neapolitan.php';
if (class_exists('LA_Mailchimp_Lists') != true) require_once 'Mailchimp/Lists.php';
if (class_exists('LA_Mailchimp_Campaigns') != true) require_once 'Mailchimp/Campaigns.php';
if (class_exists('LA_Mailchimp_Vip') != true) require_once 'Mailchimp/Vip.php';
if (class_exists('LA_Mailchimp_Reports') != true) require_once 'Mailchimp/Reports.php';
if (class_exists('LA_Mailchimp_Gallery') != true) require_once 'Mailchimp/Gallery.php';
if (class_exists('LA_Mailchimp_Goal') != true) require_once 'Mailchimp/Goal.php';
if (class_exists('LA_Mailchimp_Error') != true) require_once 'Mailchimp/Exceptions.php';

class LA_Mailchimp {
    
    public $apikey;
    public $ch;
    public $root  = 'https://api.mailchimp.com/2.0';
    public $debug = false;

    public static $error_map = array(
        "ValidationError" => "LA_Mailchimp_ValidationError",
        "ServerError_MethodUnknown" => "LA_Mailchimp_ServerError_MethodUnknown",
        "ServerError_InvalidParameters" => "LA_Mailchimp_ServerError_InvalidParameters",
        "Unknown_Exception" => "LA_Mailchimp_Unknown_Exception",
        "Request_TimedOut" => "LA_Mailchimp_Request_TimedOut",
        "Zend_Uri_Exception" => "LA_Mailchimp_Zend_Uri_Exception",
        "PDOException" => "LA_Mailchimp_PDOException",
        "Avesta_Db_Exception" => "LA_Mailchimp_Avesta_Db_Exception",
        "XML_RPC2_Exception" => "LA_Mailchimp_XML_RPC2_Exception",
        "XML_RPC2_FaultException" => "LA_Mailchimp_XML_RPC2_FaultException",
        "Too_Many_Connections" => "LA_Mailchimp_Too_Many_Connections",
        "Parse_Exception" => "LA_Mailchimp_Parse_Exception",
        "User_Unknown" => "LA_Mailchimp_User_Unknown",
        "User_Disabled" => "LA_Mailchimp_User_Disabled",
        "User_DoesNotExist" => "LA_Mailchimp_User_DoesNotExist",
        "User_NotApproved" => "LA_Mailchimp_User_NotApproved",
        "Invalid_ApiKey" => "LA_Mailchimp_Invalid_ApiKey",
        "User_UnderMaintenance" => "LA_Mailchimp_User_UnderMaintenance",
        "Invalid_AppKey" => "LA_Mailchimp_Invalid_AppKey",
        "Invalid_IP" => "LA_Mailchimp_Invalid_IP",
        "User_DoesExist" => "LA_Mailchimp_User_DoesExist",
        "User_InvalidRole" => "LA_Mailchimp_User_InvalidRole",
        "User_InvalidAction" => "LA_Mailchimp_User_InvalidAction",
        "User_MissingEmail" => "LA_Mailchimp_User_MissingEmail",
        "User_CannotSendCampaign" => "LA_Mailchimp_User_CannotSendCampaign",
        "User_MissingModuleOutbox" => "LA_Mailchimp_User_MissingModuleOutbox",
        "User_ModuleAlreadyPurchased" => "LA_Mailchimp_User_ModuleAlreadyPurchased",
        "User_ModuleNotPurchased" => "LA_Mailchimp_User_ModuleNotPurchased",
        "User_NotEnoughCredit" => "LA_Mailchimp_User_NotEnoughCredit",
        "MC_InvalidPayment" => "LA_Mailchimp_MC_InvalidPayment",
        "List_DoesNotExist" => "LA_Mailchimp_List_DoesNotExist",
        "List_InvalidInterestFieldType" => "LA_Mailchimp_List_InvalidInterestFieldType",
        "List_InvalidOption" => "LA_Mailchimp_List_InvalidOption",
        "List_InvalidUnsubMember" => "LA_Mailchimp_List_InvalidUnsubMember",
        "List_InvalidBounceMember" => "LA_Mailchimp_List_InvalidBounceMember",
        "List_AlreadySubscribed" => "LA_Mailchimp_List_AlreadySubscribed",
        "List_NotSubscribed" => "LA_Mailchimp_List_NotSubscribed",
        "List_InvalidImport" => "LA_Mailchimp_List_InvalidImport",
        "MC_PastedList_Duplicate" => "LA_Mailchimp_MC_PastedList_Duplicate",
        "MC_PastedList_InvalidImport" => "LA_Mailchimp_MC_PastedList_InvalidImport",
        "Email_AlreadySubscribed" => "LA_Mailchimp_Email_AlreadySubscribed",
        "Email_AlreadyUnsubscribed" => "LA_Mailchimp_Email_AlreadyUnsubscribed",
        "Email_NotExists" => "LA_Mailchimp_Email_NotExists",
        "Email_NotSubscribed" => "LA_Mailchimp_Email_NotSubscribed",
        "List_MergeFieldRequired" => "LA_Mailchimp_List_MergeFieldRequired",
        "List_CannotRemoveEmailMerge" => "LA_Mailchimp_List_CannotRemoveEmailMerge",
        "List_Merge_InvalidMergeID" => "LA_Mailchimp_List_Merge_InvalidMergeID",
        "List_TooManyMergeFields" => "LA_Mailchimp_List_TooManyMergeFields",
        "List_InvalidMergeField" => "LA_Mailchimp_List_InvalidMergeField",
        "List_InvalidInterestGroup" => "LA_Mailchimp_List_InvalidInterestGroup",
        "List_TooManyInterestGroups" => "LA_Mailchimp_List_TooManyInterestGroups",
        "Campaign_DoesNotExist" => "LA_Mailchimp_Campaign_DoesNotExist",
        "Campaign_StatsNotAvailable" => "LA_Mailchimp_Campaign_StatsNotAvailable",
        "Campaign_InvalidAbsplit" => "LA_Mailchimp_Campaign_InvalidAbsplit",
        "Campaign_InvalidContent" => "LA_Mailchimp_Campaign_InvalidContent",
        "Campaign_InvalidOption" => "LA_Mailchimp_Campaign_InvalidOption",
        "Campaign_InvalidStatus" => "LA_Mailchimp_Campaign_InvalidStatus",
        "Campaign_NotSaved" => "LA_Mailchimp_Campaign_NotSaved",
        "Campaign_InvalidSegment" => "LA_Mailchimp_Campaign_InvalidSegment",
        "Campaign_InvalidRss" => "LA_Mailchimp_Campaign_InvalidRss",
        "Campaign_InvalidAuto" => "LA_Mailchimp_Campaign_InvalidAuto",
        "MC_ContentImport_InvalidArchive" => "LA_Mailchimp_MC_ContentImport_InvalidArchive",
        "Campaign_BounceMissing" => "LA_Mailchimp_Campaign_BounceMissing",
        "Campaign_InvalidTemplate" => "LA_Mailchimp_Campaign_InvalidTemplate",
        "Invalid_EcommOrder" => "LA_Mailchimp_Invalid_EcommOrder",
        "Absplit_UnknownError" => "LA_Mailchimp_Absplit_UnknownError",
        "Absplit_UnknownSplitTest" => "LA_Mailchimp_Absplit_UnknownSplitTest",
        "Absplit_UnknownTestType" => "LA_Mailchimp_Absplit_UnknownTestType",
        "Absplit_UnknownWaitUnit" => "LA_Mailchimp_Absplit_UnknownWaitUnit",
        "Absplit_UnknownWinnerType" => "LA_Mailchimp_Absplit_UnknownWinnerType",
        "Absplit_WinnerNotSelected" => "LA_Mailchimp_Absplit_WinnerNotSelected",
        "Invalid_Analytics" => "LA_Mailchimp_Invalid_Analytics",
        "Invalid_DateTime" => "LA_Mailchimp_Invalid_DateTime",
        "Invalid_Email" => "LA_Mailchimp_Invalid_Email",
        "Invalid_SendType" => "LA_Mailchimp_Invalid_SendType",
        "Invalid_Template" => "LA_Mailchimp_Invalid_Template",
        "Invalid_TrackingOptions" => "LA_Mailchimp_Invalid_TrackingOptions",
        "Invalid_Options" => "LA_Mailchimp_Invalid_Options",
        "Invalid_Folder" => "LA_Mailchimp_Invalid_Folder",
        "Invalid_URL" => "LA_Mailchimp_Invalid_URL",
        "Module_Unknown" => "LA_Mailchimp_Module_Unknown",
        "MonthlyPlan_Unknown" => "LA_Mailchimp_MonthlyPlan_Unknown",
        "Order_TypeUnknown" => "LA_Mailchimp_Order_TypeUnknown",
        "Invalid_PagingLimit" => "LA_Mailchimp_Invalid_PagingLimit",
        "Invalid_PagingStart" => "LA_Mailchimp_Invalid_PagingStart",
        "Max_Size_Reached" => "LA_Mailchimp_Max_Size_Reached",
        "MC_SearchException" => "LA_Mailchimp_MC_SearchException",
        "Goal_SaveFailed" => "LA_Mailchimp_Goal_SaveFailed",
        "Conversation_DoesNotExist" => "LA_Mailchimp_Conversation_DoesNotExist",
        "Conversation_ReplySaveFailed" => "LA_Mailchimp_Conversation_ReplySaveFailed",
        "File_Not_Found_Exception" => "LA_Mailchimp_File_Not_Found_Exception",
        "Folder_Not_Found_Exception" => "LA_Mailchimp_Folder_Not_Found_Exception",
        "Folder_Exists_Exception" => "LA_Mailchimp_Folder_Exists_Exception"
    );

    public function __construct($apikey=null, $opts=array()) {
        if (!$apikey) {
            $apikey = getenv('MAILCHIMP_APIKEY');
        }

        if (!$apikey) {
            $apikey = $this->readConfigs();
        }

        if (!$apikey) {
            throw new LA_Mailchimp_Error('You must provide a MailChimp API key');
        }

        $this->apikey = $apikey;
        $dc           = "us1";

        if (strstr($this->apikey, "-")){
            list($key, $dc) = explode("-", $this->apikey, 2);
            if (!$dc) {
                $dc = "us1";
            }
        }

        $this->root = str_replace('https://api', 'https://' . $dc . '.api', $this->root);
        $this->root = rtrim($this->root, '/') . '/';

        if (!isset($opts['timeout']) || !is_int($opts['timeout'])){
            $opts['timeout'] = 600;
        }
        if (isset($opts['debug'])){
            $this->debug = true;
        }


        $this->ch = curl_init();

        if (isset($opts['CURLOPT_FOLLOWLOCATION']) && $opts['CURLOPT_FOLLOWLOCATION'] === true) {
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        }

        curl_setopt($this->ch, CURLOPT_USERAGENT, 'MailChimp-PHP/2.0.5');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $opts['timeout']);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); # http://redwebturtle.blogspot.com/2013/09/mailchimp-api-v20-ssl-error-solution.html


        $this->folders = new LA_Mailchimp_Folders($this);
        $this->templates = new LA_Mailchimp_Templates($this);
        $this->users = new LA_Mailchimp_Users($this);
        $this->helper = new LA_Mailchimp_Helper($this);
        $this->mobile = new LA_Mailchimp_Mobile($this);
        $this->conversations = new LA_Mailchimp_Conversations($this);
        $this->ecomm = new LA_Mailchimp_Ecomm($this);
        $this->neapolitan = new LA_Mailchimp_Neapolitan($this);
        $this->lists = new LA_Mailchimp_Lists($this);
        $this->campaigns = new LA_Mailchimp_Campaigns($this);
        $this->vip = new LA_Mailchimp_Vip($this);
        $this->reports = new LA_Mailchimp_Reports($this);
        $this->gallery = new LA_Mailchimp_Gallery($this);
        $this->goal = new LA_Mailchimp_Goal($this);
    }

    public function __destruct() {
        curl_close($this->ch);
    }

    public function call($url, $params) {
        $params['apikey'] = $this->apikey;
        
        $params = json_encode($params);
        $ch     = $this->ch;

        curl_setopt($ch, CURLOPT_URL, $this->root . $url . '.json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

        $start = microtime(true);
        $this->log('Call to ' . $this->root . $url . '.json: ' . $params);
        if($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
        }

        $response_body = curl_exec($ch);

        $info = curl_getinfo($ch);
        $time = microtime(true) - $start;
        if($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if(curl_error($ch)) {
            throw new LA_Mailchimp_HttpError("API call to $url failed: " . curl_error($ch));
        }
        $result = json_decode($response_body, true);
        
        if(floor($info['http_code'] / 100) >= 4) {
            throw $this->castError($result);
        }

        return $result;
    }

    public function readConfigs() {
        $paths = array('~/.mailchimp.key', '/etc/mailchimp.key');
        foreach($paths as $path) {
            if(file_exists($path)) {
                $apikey = trim(file_get_contents($path));
                if ($apikey) {
                    return $apikey;
                }
            }
        }
        return false;
    }

    public function castError($result) {
        if ($result['status'] !== 'error' || !$result['name']) {
            throw new LA_Mailchimp_Error('We received an unexpected error: ' . json_encode($result));
        }

        $class = (isset(self::$error_map[$result['name']])) ? self::$error_map[$result['name']] : 'LA_Mailchimp_Error';
        return new $class($result['error'], $result['code']);
    }

    public function log($msg) {
        if ($this->debug) {
            error_log($msg);
        }
    }
}


