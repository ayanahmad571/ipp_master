Readme

Places where Work Order header are Placed
Work_order_sales.php
Work_order_sales_generate.php
If some dependency is deleted at a later stage, the state of the application is maintained because of the way data is stored.

Admin Functions
Client 
Sales Attach
Qty Units
Structure Types


Take all the radios and Checkboxes to the database.
Db Control of those values.

NUmeric State is not currently in Strict Mode

TRUNCATE `conditional_release_wo`;
TRUNCATE `logcat_main`;
TRUNCATE `master_work_order_main`;
TRUNCATE `master_work_order_reference_number`;
TRUNCATE `remarks_wo`;
TRUNCATE `session_tracker`;
TRUNCATE `users_pending`;
ALTER TABLE master_work_order_reference_number AUTO_INCREMENT = 8000;


ippcontrols.com
