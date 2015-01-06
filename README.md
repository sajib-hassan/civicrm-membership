civicrm-membership
==================

Membership: When a General membership expired at the end of the grace period, the system will automatically create an one year Associate membership with the since date and starting date set at the end of the grace period.

Install
======

git clone https://github.com/sajib-hassan/civicrm-membership.git in your local extension repository and it should work

I'll provide a zip soon

Configuration
=============
You need to add in your civicrm.settings.php a new config variable
global $civicrm_setting;
$civicrm_setting['com.appcodifier.civimembership']['params'] = array(
	'from_membership_type' => 1, // General
	'to_membership_type' => 10, // Associate
	'source' => 'Membership Update Script'
);

Test & Access right
===================

Before start testing we must know regarding "Override Status" from backend UI:
Membership status is normally assigned and updated automatically based on our configured membership status rules. However, if we want to assign a status manually and bypass automated status setting, check this box. Then we can select from the available status options.

The status we assign will remain in force, unless it is again modified on this screen. As long as the Status Override flag is checked, the automated membership status update script will NOT update this membership record.

Test steps are -

Step 1: Find out a contact
Make sure a contact that has "General Membership" and will be expired today. Expired today will be calculated by - 
"Expired today" >= "Membership end date" + "(2 months Grace period - as per configured status rule of Grace)"
For example, Jan 06, 2015 >= Nov 4, 2014 + 2 months find-out-a-contact.png

Step 2: Run "Membership status processor (Daily)" scheduled job from Admin UI
Go to: Administer >> System Settings >> Scheduled Jobs
Select "more" link of "Membership status processor (Daily)" scheduled job row. Click on "Execute Now" Just looks like as bellow picture - membership-status-processor.png

Step 3: See the result
"General Membership" will be expired. A new "Associate Membership" has been created with Join date, Start date of today and End date will assign after 1 year of Start date as per task requirements. results.png

Support and Evolutions
=====================
Ask in the extensions forum on civicrm.org. 

In general, if you have an idea and the skills to implement it (or the budget to make it happen), it will be added.
