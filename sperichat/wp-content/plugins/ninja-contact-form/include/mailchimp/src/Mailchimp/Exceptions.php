<?php

class LA_Mailchimp_Error extends Exception {}
class LA_Mailchimp_HttpError extends LA_Mailchimp_Error {}

/**
 * The parameters passed to the API call are invalid or not provided when required
 */
class LA_Mailchimp_ValidationError extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_ServerError_MethodUnknown extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_ServerError_InvalidParameters extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Unknown_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Request_TimedOut extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Zend_Uri_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_PDOException extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Avesta_Db_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_XML_RPC2_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_XML_RPC2_FaultException extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Too_Many_Connections extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Parse_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_Unknown extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_Disabled extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_DoesNotExist extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_NotApproved extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_ApiKey extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_UnderMaintenance extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_AppKey extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_IP extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_DoesExist extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_InvalidRole extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_InvalidAction extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_MissingEmail extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_CannotSendCampaign extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_MissingModuleOutbox extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_ModuleAlreadyPurchased extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_ModuleNotPurchased extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_User_NotEnoughCredit extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MC_InvalidPayment extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_DoesNotExist extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidInterestFieldType extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidOption extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidUnsubMember extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidBounceMember extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_AlreadySubscribed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_NotSubscribed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidImport extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MC_PastedList_Duplicate extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MC_PastedList_InvalidImport extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Email_AlreadySubscribed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Email_AlreadyUnsubscribed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Email_NotExists extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Email_NotSubscribed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_MergeFieldRequired extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_CannotRemoveEmailMerge extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_Merge_InvalidMergeID extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_TooManyMergeFields extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidMergeField extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_InvalidInterestGroup extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_List_TooManyInterestGroups extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_DoesNotExist extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_StatsNotAvailable extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidAbsplit extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidContent extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidOption extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidStatus extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_NotSaved extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidSegment extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidRss extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidAuto extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MC_ContentImport_InvalidArchive extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_BounceMissing extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Campaign_InvalidTemplate extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_EcommOrder extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_UnknownError extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_UnknownSplitTest extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_UnknownTestType extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_UnknownWaitUnit extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_UnknownWinnerType extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Absplit_WinnerNotSelected extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_Analytics extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_DateTime extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_Email extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_SendType extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_Template extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_TrackingOptions extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_Options extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_Folder extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_URL extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Module_Unknown extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MonthlyPlan_Unknown extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Order_TypeUnknown extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_PagingLimit extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Invalid_PagingStart extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Max_Size_Reached extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_MC_SearchException extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Goal_SaveFailed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Conversation_DoesNotExist extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Conversation_ReplySaveFailed extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_File_Not_Found_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Folder_Not_Found_Exception extends LA_Mailchimp_Error {}

/**
 * None
 */
class LA_Mailchimp_Folder_Exists_Exception extends LA_Mailchimp_Error {}


