# Access Control by Financial Type for Reports

## biz.jmaconsulting.financialaclreports

This extension is required if your site has not enabled access control by financial type at Administer > CiviContribute Component Settings, and not relevant otherwise.

Access control by financial types allows sites to restrict create, read, update and delete operations by user role by financial type. For example, bequests could be hidden from everyone except the staff person responsible for major gifts, or membership staff could be restricted to seeing just financial records associated with memberships. This is sometimes called financial ACLs (ie access control lists).

It wasn't feasible to implement this in an extension and so they are in CiviCRM core. 

However, adding support for restricting viewing of financial information in all relevant reports causes a significant performance degradation on some very large sites. 

So the relevant functionality for the reports has been (re-)packaged into this extension.

## Installation

Ensure that the regular setup for using extensions on your site is configured (Directories, URLs). Then download and enable this extension.

For more information on configuring access control by financial type, see the relevant core CiviCRM documentation.
