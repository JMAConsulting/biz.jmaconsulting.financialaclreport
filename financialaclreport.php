<?php

require_once 'financialaclreport.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function financialaclreport_civicrm_config(&$config) {
  _financialaclreport_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function financialaclreport_civicrm_xmlMenu(&$files) {
  _financialaclreport_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function financialaclreport_civicrm_install() {
  _financialaclreport_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function financialaclreport_civicrm_uninstall() {
  _financialaclreport_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function financialaclreport_civicrm_enable() {
  _financialaclreport_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function financialaclreport_civicrm_disable() {
  _financialaclreport_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function financialaclreport_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _financialaclreport_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function financialaclreport_civicrm_managed(&$entities) {
  _financialaclreport_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function financialaclreport_civicrm_caseTypes(&$caseTypes) {
  _financialaclreport_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function financialaclreport_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _financialaclreport_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_selectWhereClause().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_selectWhereClause
 */
function financialaclreport_civicrm_selectWhereClause($entity, &$clauses) {
  static $count;
  if ($entity != 'Contribution') {
    return;
  }

  if (!CRM_Financial_BAO_FinancialType::isACLFinancialTypeStatus()) {
    return FALSE;
  }
  $allFinancialTypes = CRM_Contribute_Pseudoconstant::financialType();
  $allowedFinancialTypes = CRM_Financial_BAO_FinancialType::getAvailableFinancialTypes();
  $financialTypes = array_diff($allFinancialTypes, $allowedFinancialTypes);
  if (empty($financialTypes)) {
    $financialTypes = array(0);
  }

  $count = empty($count) ? 1 : $count + 1;
  $tempTable = "civicrm_contribution_financial_type_temp_" . $count;
  CRM_Core_DAO::executeQuery("DROP TEMPORARY TABLE IF EXISTS $tempTable");
  $sql = "CREATE TEMPORARY TABLE $tempTable AS
            SELECT civicrm_contribution_ft.id
            FROM civicrm_contribution civicrm_contribution_ft
            LEFT JOIN civicrm_line_item  civicrm_line_item_ft
              ON civicrm_contribution_ft.id = civicrm_line_item_ft.contribution_id
              AND civicrm_line_item_ft.financial_type_id IN (" . implode(', ', array_keys($financialTypes)) . ")
            WHERE civicrm_contribution_ft.financial_type_id IN (" . implode(', ', array_keys($financialTypes)) . ")
            AND civicrm_line_item_ft.id IS NOT NULL
            GROUP BY civicrm_contribution_ft.id";
  CRM_Core_DAO::executeQuery($sql);
  $clauses['id'] = "NOT IN (SELECT id FROM $tempTable)";
}
