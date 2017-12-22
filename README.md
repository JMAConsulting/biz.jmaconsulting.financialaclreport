# Access Control by Financial Type for Reports

## biz.jmaconsulting.financialaclreports

This extension is required if your site has not enabled access control by financial type at Administer > CiviContribute Component Settings, and not relevant otherwise.

Access control by financial types allows sites to restrict create, read, update and delete operations by user role by financial type. For example, bequests could be hidden from everyone except the staff person responsible for major gifts, or membership staff could be restricted to seeing just financial records associated with memberships. This is sometimes called financial ACLs (ie access control lists).

It wasn't feasible to implement this in an extension and so they are in CiviCRM core.

However, adding support for restricting viewing of financial information in all relevant reports causes a significant performance degradation on some very large sites.

So the relevant functionality for the reports has been (re-)packaged into this extension.

## Installation

1. If you have not already done so, setup Extensions Directory
    1. Go to Administer >> System Settings >> Directories
        1. Set an appropriate value for CiviCRM Extensions Directory. For example, for Drupal, [civicrm.files]/ext/
        1. In a different window, ensure the directory exists and is readable by your web server process.
    1. Click Save.
1. If you have not already done so, setup Extensions Resources URL
    1. Go to Administer >> System Settings >> Resource URLs
        1. Beside Extension Resource URL, enter an appropriate values such as [civicrm.files]/ext/
    1. Click Save.
1. Install Access Control by Financial Type for Reports extension
    1. Go to Administer >> Customize Data and Screens >> Manage Extensions.
    1. Click on Add New tab.
    1. If Access Control by Financial Type for Reports is not in the list of extensions, manually download it and unzip it into the extensions direction setup above, then return to this page.
    1. Beside Access Control by Financial Type for Reports, click Download.
    1. Review the information, then click Download and Install.

For more information on configuring access control by financial type, see the relevant core CiviCRM documentation.
