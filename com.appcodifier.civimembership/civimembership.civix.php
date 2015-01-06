<?php

// AUTO-GENERATED FILE -- Civix may overwrite any changes made to this file

/**
 * (Delegated) Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function _civimembership_civix_civicrm_config(&$config = NULL) {
  static $configured = FALSE;
  if ($configured) return;
  $configured = TRUE;

  $template =& CRM_Core_Smarty::singleton();

  $extRoot = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
  $extDir = $extRoot . 'templates';

  if ( is_array( $template->template_dir ) ) {
      array_unshift( $template->template_dir, $extDir );
  } else {
      $template->template_dir = array( $extDir, $template->template_dir );
  }

  $include_path = $extRoot . PATH_SEPARATOR . get_include_path( );
  set_include_path( $include_path );
}

/**
 * (Delegated) Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function _civimembership_civix_civicrm_xmlMenu(&$files) {
  foreach (_civimembership_civix_glob(__DIR__ . '/xml/Menu/*.xml') as $file) {
    $files[] = $file;
  }
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function _civimembership_civix_civicrm_install() {
  _civimembership_civix_civicrm_config();
  if ($upgrader = _civimembership_civix_upgrader()) {
    $upgrader->onInstall();
  }
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function _civimembership_civix_civicrm_uninstall() {
  _civimembership_civix_civicrm_config();
  if ($upgrader = _civimembership_civix_upgrader()) {
    $upgrader->onUninstall();
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function _civimembership_civix_civicrm_enable() {
  _civimembership_civix_civicrm_config();
  if ($upgrader = _civimembership_civix_upgrader()) {
    if (is_callable(array($upgrader, 'onEnable'))) {
      $upgrader->onEnable();
    }
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 * @return mixed
 */
function _civimembership_civix_civicrm_disable() {
  _civimembership_civix_civicrm_config();
  if ($upgrader = _civimembership_civix_upgrader()) {
    if (is_callable(array($upgrader, 'onDisable'))) {
      $upgrader->onDisable();
    }
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function _civimembership_civix_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  if ($upgrader = _civimembership_civix_upgrader()) {
    return $upgrader->onUpgrade($op, $queue);
  }
}

/**
 * @return CRM_Civimembership_Upgrader
 */
function _civimembership_civix_upgrader() {
  if (!file_exists(__DIR__.'/CRM/Civimembership/Upgrader.php')) {
    return NULL;
  } else {
    return CRM_Civimembership_Upgrader_Base::instance();
  }
}

/**
 * Search directory tree for files which match a glob pattern
 *
 * Note: Dot-directories (like "..", ".git", or ".svn") will be ignored.
 * Note: In Civi 4.3+, delegate to CRM_Utils_File::findFiles()
 *
 * @param $dir string, base dir
 * @param $pattern string, glob pattern, eg "*.txt"
 * @return array(string)
 */
function _civimembership_civix_find_files($dir, $pattern) {
  if (is_callable(array('CRM_Utils_File', 'findFiles'))) {
    return CRM_Utils_File::findFiles($dir, $pattern);
  }

  $todos = array($dir);
  $result = array();
  while (!empty($todos)) {
    $subdir = array_shift($todos);
    foreach (_civimembership_civix_glob("$subdir/$pattern") as $match) {
      if (!is_dir($match)) {
        $result[] = $match;
      }
    }
    if ($dh = opendir($subdir)) {
      while (FALSE !== ($entry = readdir($dh))) {
        $path = $subdir . DIRECTORY_SEPARATOR . $entry;
        if ($entry{0} == '.') {
        } elseif (is_dir($path)) {
          $todos[] = $path;
        }
      }
      closedir($dh);
    }
  }
  return $result;
}
/**
 * (Delegated) Implementation of hook_civicrm_managed
 *
 * Find any *.mgd.php files, merge their content, and return.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function _civimembership_civix_civicrm_managed(&$entities) {
  $mgdFiles = _civimembership_civix_find_files(__DIR__, '*.mgd.php');
  foreach ($mgdFiles as $file) {
    $es = include $file;
    foreach ($es as $e) {
      if (empty($e['module'])) {
        $e['module'] = 'com.appcodifier.civimembership';
      }
      $entities[] = $e;
    }
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_caseTypes
 *
 * Find any and return any files matching "xml/case/*.xml"
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function _civimembership_civix_civicrm_caseTypes(&$caseTypes) {
  if (!is_dir(__DIR__ . '/xml/case')) {
    return;
  }

  foreach (_civimembership_civix_glob(__DIR__ . '/xml/case/*.xml') as $file) {
    $name = preg_replace('/\.xml$/', '', basename($file));
    if ($name != CRM_Case_XMLProcessor::mungeCaseType($name)) {
      $errorMessage = sprintf("Case-type file name is malformed (%s vs %s)", $name, CRM_Case_XMLProcessor::mungeCaseType($name));
      CRM_Core_Error::fatal($errorMessage);
      // throw new CRM_Core_Exception($errorMessage);
    }
    $caseTypes[$name] = array(
      'module' => 'com.appcodifier.civimembership',
      'name' => $name,
      'file' => $file,
    );
  }
}

/**
 * Glob wrapper which is guaranteed to return an array.
 *
 * The documentation for glob() says, "On some systems it is impossible to
 * distinguish between empty match and an error." Anecdotally, the return
 * result for an empty match is sometimes array() and sometimes FALSE.
 * This wrapper provides consistency.
 *
 * @link http://php.net/glob
 * @param string $pattern
 * @return array, possibly empty
 */
function _civimembership_civix_glob($pattern) {
  $result = glob($pattern);
  return is_array($result) ? $result : array();
}

/**
 * Inserts a navigation menu item at a given place in the hierarchy
 *
 * $menu - menu hierarchy
 * $path - path where insertion should happen (ie. Administer/System Settings)
 * $item - menu you need to insert (parent/child attributes will be filled for you)
 * $parentId - used internally to recurse in the menu structure
 */
function _civimembership_civix_insert_navigation_menu(&$menu, $path, $item, $parentId = NULL) {
  static $navId;

  // If we are done going down the path, insert menu
  if (empty($path)) {
    if (!$navId) $navId = CRM_Core_DAO::singleValueQuery("SELECT max(id) FROM civicrm_navigation");
    $navId ++;
    $menu[$navId] = array (
      'attributes' => array_merge($item, array(
        'label'      => CRM_Utils_Array::value('name', $item),
        'active'     => 1,
        'parentID'   => $parentId,
        'navID'      => $navId,
      ))
    );
    return true;
  } else {
    // Find an recurse into the next level down
    $found = false;
    $path = explode('/', $path);
    $first = array_shift($path);
    foreach ($menu as $key => &$entry) {
      if ($entry['attributes']['name'] == $first) {
        if (!$entry['child']) $entry['child'] = array();
        $found = _civimembership_civix_insert_navigation_menu($entry['child'], implode('/', $path), $item, $key);
      }
    }
    return $found;
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function _civimembership_civix_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  static $configured = FALSE;
  if ($configured) return;
  $configured = TRUE;

  $settingsDir = __DIR__ . DIRECTORY_SEPARATOR . 'settings';
  if(is_dir($settingsDir) && !in_array($settingsDir, $metaDataFolders)) {
    $metaDataFolders[] = $settingsDir;
  }
}

/**
 * (Delegated) Implementation of hook_civicrm_alterCalculatedMembershipStatus
 * When a General membership expired at the end of the grace period, the system will automatically create an one year Associate membership with the since date and starting date set at the end of the grace period.
 * @param array $membershipStatus the calculated membership status array
 * @param array $arguments arguments used in the calculation
 * @param array $membership the membership array from the calling function
 * @link http://wiki.civicrm.org/confluence/pages/viewpage.action?pageId=120946716
 */
function _civimembership_civicrm_alterCalculatedMembershipStatus(&$membershipStatus, $arguments, $membership) {
    //Read configurations
    $config = CRM_Core_BAO_Setting::getItem('com.appcodifier.civimembership', 'params');
    $config = array_merge(array('from_membership_type' => 1, 'to_membership_type' => 10, 'source' => 'Membership Update Script'), (array) $config);

    //check that is it "General membership" expired ?
    if (empty($arguments['membership_type_id']) || !in_array($arguments['membership_type_id'], array($config['from_membership_type'])) || empty($membershipStatus['name']) || (strtolower($membershipStatus['name']) !== 'expired')) {
        return;
    }

    $today = CRM_Utils_Date::getToday();
    try {
        //get member record for contact id.
        $membershipData = civicrm_api('membership', 'get', $membership);
        if (CRM_Utils_Array::value('is_error', $membershipData, 0) == 0) {
            $params = array(
                'contact_id' => CRM_Utils_Array::value('contact_id', $membershipData['values'][$membership['membership_id']]),
                'membership_type_id' => $config['to_membership_type'],
                'join_date' => $today,
                'start_date' => $today,
                'source' => $config['source'],
                'version' => $membership['version']
            );
            //process member record.
            civicrm_api('membership', 'create', $params);
        }
    } catch (CiviCRM_API3_Exception $e) {
        // handle error here
        $errorMessage = $e->getMessage();
        $errorCode = $e->getErrorCode();
        $errorData = $e->getExtraParams();
    } catch (Exception $e) {
    }
    return;
}