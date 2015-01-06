<?php

require_once 'civimembership.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function civimembership_civicrm_config(&$config) {
  _civimembership_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function civimembership_civicrm_xmlMenu(&$files) {
  _civimembership_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civimembership_civicrm_install() {
  _civimembership_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function civimembership_civicrm_uninstall() {
  _civimembership_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civimembership_civicrm_enable() {
  _civimembership_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function civimembership_civicrm_disable() {
  _civimembership_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function civimembership_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civimembership_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function civimembership_civicrm_managed(&$entities) {
  _civimembership_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civimembership_civicrm_caseTypes(&$caseTypes) {
  _civimembership_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function civimembership_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civimembership_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
/**
 * Implementation of hook_civicrm_alterCalculatedMembershipStatus
 * Set membership status according to membership type
 * @param array $membershipStatus the calculated membership status array
 * @param array $arguments arguments used in the calculation
 * @param array $membership the membership array from the calling function
 * @link http://wiki.civicrm.org/confluence/pages/viewpage.action?pageId=120946716
 */
function civimembership_civicrm_alterCalculatedMembershipStatus(&$membershipStatus, $arguments, $membership) {
    _civimembership_civicrm_alterCalculatedMembershipStatus($membershipStatus, $arguments, $membership);
}