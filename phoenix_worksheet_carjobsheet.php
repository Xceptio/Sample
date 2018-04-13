<?php 
session_start();
include('application/libraries/FileMaker.php');
require_once(APPPATH.'libraries/phpmailer/class.phpmailer.php');
require_once(APPPATH.'libraries/phpmailer/PHPMailerAutoload.php');

$fm = new FileMaker('Live PFAM NEW', 'armontsys.ddns.net', 'Admin', 'enzio');

$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (strpos($host, 'carjob_sheet') !== false)
{
 $request = $fm->newFindCommand('Carjobsheet');
 $request->addFindCriterion('Sheet Type', "2");

  if(empty($_GET['skip']))
  {
  $skip=0; // Default shows the first record
  }
  else
  {
  $skip=$_GET['skip'];
  }
if(empty($_GET['max']))
  {
  $max=1; // Default for record navigation is 1 record at time
  }
  else
  {
  $max=$_GET['max'];
  }
$request->setRange($skip, $max);

# Execute the find request
$result = $request->execute();

if (FileMaker::isError($result))
  {
  echo "<p>" . $result->getMessage() . "</p>";
  exit;
  }


# Get the result record set as an array of record objects. This is technically your found set of records.
$records = $result->getRecords();


if(empty($_GET['skip']) or empty($_GET['max']))
  {
  $currentRecord = 1;
  }
  else
  {
  $currentRecord = $_GET['skip'] + $_GET['max'];
  }
$found = $result->getFoundSetCount();
$total = $result->getTableRecordCount();


        /* Navigation */

# FIRST RECORD
  if ($skip > 0 )
    {
    }
  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  # PREVIOUS RECORD
  $previous = $skip-1;
  if ($skip > 0)
    {

    }
  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  #NEXT RECORD
  $next = $skip+1;
  if ($skip+1 < $found)
    {
    }


  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  #LAST RECORD
  $last = $found-1;
  if ($skip+1 < $found)
    {
    }
  else
    {
    //echo '<img src="Images/last_record.jpg" border=0/>';
    }

    $new_previous = $previous - 2;
    $new_next = $next + 2;
    $total_new_record = $last + 1;
        /* Navigation */

   foreach ($records as $record)
      {
       

                    $record_IDinfo =  $record->getRecordId();

                    /* Pagination */
                    $nextrecordnum = $next + 1;
                    $total_add_record = $total_new_record;
                    $first_record =  $_SERVER['PHP_SELF'] . "?skip=0&max=1";
                    $previous_record_three = $_SERVER['PHP_SELF'] . '?skip=' . $new_previous  . '&max=1';
                    $previous_record = $_SERVER['PHP_SELF'] . '?skip=' . $previous . '&max=1';
                    $next_record =  $_SERVER['PHP_SELF'] . '?skip=' . $next . '&max=1';
                    $next_record_three =  $_SERVER['PHP_SELF'] . '?skip=' .  $new_next . '&max=1';
                    $last_record =  $_SERVER['PHP_SELF'] . '?skip=' . $last . '&max=1';
                    $skipcurrent = $skip;
                    /* pagination */


                    /* Records No. */

                    $current_record_num =  $currentRecord;
                    $found_record = $found;
                    $total = $total;
                    /* Records No. */

                    //////////////// Created and Modified Information ///////////
                    $createdbyperson = $record->getField('_created_by');
                    $createdtime = $record->getField('_time_created');
                    $createddate = $record->getField('_date_created');
                    $modifiedbyperson = $record->getField('_modified_by');
                    $modifiedtime = $record->getField('_time_modified');
                    $modifieddate = $record->getField('_date_modified');
                    //////////////// Created and Modified Information ///////////
                    //////////////----------------------------------////////////////
                    $job_number_info = $record->getField('Job Number');


                    $city_CAR  = $record->getField('City 1');
                    $site_CAR = $record->getField('Site ID#');
                    $strata_plan_CAR = $record->getField('Strata Plan');
                    $street_CAR = $record->getField('Street 1');
                    $postal_code_CAR = $record->getField('Postal Code');
                    $Company_CAR = $record->getField('Company');
                    $Notes_CAR = $record->getField('Notes');


    /* CAR Job Work Sheet */
                $service_date_carjobsheet = $record->getField('Service Date');
                $service_time = $record->getField('Service Time');
                $unit_time =  $record->getField('Unit_Time');
                $Technician_CAR =  $record->getField('Technician');
                $servicetype_CAR =  $record->getField('Service Type');
                $Factored_nonfactored =  $record->getField('Factored_Non_Factored');
                $key_register_hash =  $record->getField('Key_Register_ID_CJS');
                $work_order =  $record->getField('Work Order');
                $invoice_hash =  $record->getField('Invoice #');
                $CAR_hash =  $record->getField('CAR#');
    /* CAR Job Work Sheet */


    /* Total breakdown */
               $CAR_current_total =  $record->getField('Car_Current_Total');
               $CAR_invoice_value =  $record->getField('CAR Invoice Value');
               $TotalHours_Annual =  $record->getField('Total Hours AnnualModifiable');
               $CarQuotedPercentage =  $record->getField('%CARQUOTEDISCOUNTPERCENTAGE');
               $CarquoatedDiscount =  $record->getField('%CARQUOTEDISCOUNTVALUE');
               $Car_Discount_Total =  $record->getField('%CARQUOTEDISCOUNTTOTAL');
               $CAR_GST =  $record->getField('CAR GST Job');
               $CAR_Total_Job =  $record->getField('CAR Total Job');
    /* Total breakdown */

    /* Notes */
             $notes_details =  $record->getField('Notes');
             $tenant_details =  $record->getField('tenant details');
             $comments =  $record->getField('comments');
    /* Notes */

    /* Other Information */
             $completed_yn =  $record->getField('Completed Y/N');
             $manager_approval =  $record->getField('Manager Approval');
             $letter_sent =  $record->getField('letters sent');
             $letters_sentdateinfo =  $record->getField('Letters sent date');
             $textsent_info =  $record->getField('Text Sent');
             $textdate_info =  $record->getField('Text Date');
             $acceptedby =  $record->getField('Accepted By');
             $accepteddate =  $record->getField('Accepted Date');
             $sent_contractor =  $record->getField('Sent to Contractor');
             $contractor =  $record->getField('Contractor');
             $contractor_test =  $record->getField('Contractor Payment Test');

   /* Template Check */
           $template_check_text1 =  $record->getField('Template Check Text 1');
           $template_check_text2 =  $record->getField('Template Check Text 2');
           $template_check_text3 =  $record->getField('Template Check Text 3');
     }


} else if (strpos($host, 'infonumber_two') !== false) {

  $worksheet_numberinformation_two = $_GET['jobnum'];

  $request = $fm->newFindCommand('Carjobsheet');
  $request->addFindCriterion('Sheet Type', "2");
  $request->addFindCriterion('Job Number', $worksheet_numberinformation_two);

  if(empty($_GET['skip']))
  {
  $skip=0; // Default shows the first record
  }
  else
  {
  $skip=$_GET['skip'];
  }
if(empty($_GET['max']))
  {
  $max=1; // Default for record navigation is 1 record at time
  }
  else
  {
  $max=$_GET['max'];
  }
$request->setRange($skip, $max);

# Execute the find request
$result = $request->execute();

if (FileMaker::isError($result))
  {
  echo "<p>" . $result->getMessage() . "</p>";
  exit;
  }


# Get the result record set as an array of record objects. This is technically your found set of records.
$records = $result->getRecords();


if(empty($_GET['skip']) or empty($_GET['max']))
  {
  $currentRecord = 1;
  }
  else
  {
  $currentRecord = $_GET['skip'] + $_GET['max'];
  }
$found = $result->getFoundSetCount();
$total = $result->getTableRecordCount();


        /* Navigation */

# FIRST RECORD
  if ($skip > 0 )
    {
    }
  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  # PREVIOUS RECORD
  $previous = $skip-1;
  if ($skip > 0)
    {

    }
  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  #NEXT RECORD
  $next = $skip+1;
  if ($skip+1 < $found)
    {
    }


  else
    {
    }
  ?>
  </td>
    <td>
  <?php
  #LAST RECORD
  $last = $found-1;
  if ($skip+1 < $found)
    {
    }
  else
    {
    //echo '<img src="Images/last_record.jpg" border=0/>';
    }

    $new_previous = $previous - 2;
    $new_next = $next + 2;
    $total_new_record = $last + 1;
        /* Navigation */

   foreach ($records as $record)
      {
       

                    $record_IDinfo =  $record->getRecordId();

                    /* Pagination */
                    $nextrecordnum = $next + 1;
                    $total_add_record = $total_new_record;
                    $first_record =  $_SERVER['PHP_SELF'] . "?skip=0&max=1";
                    $previous_record_three = $_SERVER['PHP_SELF'] . '?skip=' . $new_previous  . '&max=1';
                    $previous_record = $_SERVER['PHP_SELF'] . '?skip=' . $previous . '&max=1';
                    $next_record =  $_SERVER['PHP_SELF'] . '?skip=' . $next . '&max=1';
                    $next_record_three =  $_SERVER['PHP_SELF'] . '?skip=' .  $new_next . '&max=1';
                    $last_record =  $_SERVER['PHP_SELF'] . '?skip=' . $last . '&max=1';
                    $skipcurrent = $skip;
                    /* pagination */


                    /* Records No. */

                    $current_record_num =  $currentRecord;
                    $found_record = $found;
                    $total = $total;
                    /* Records No. */

                    //////////////// Created and Modified Information ///////////
                    $createdbyperson = $record->getField('_created_by');
                    $createdtime = $record->getField('_time_created');
                    $createddate = $record->getField('_date_created');
                    $modifiedbyperson = $record->getField('_modified_by');
                    $modifiedtime = $record->getField('_time_modified');
                    $modifieddate = $record->getField('_date_modified');
                    //////////////// Created and Modified Information ///////////
                    //////////////----------------------------------////////////////
                    $job_number_info = $record->getField('Job Number');


                    $city_CAR  = $record->getField('City 1');
                    $site_CAR = $record->getField('Site ID#');
                    $strata_plan_CAR = $record->getField('Strata Plan');
                    $street_CAR = $record->getField('Street 1');
                    $postal_code_CAR = $record->getField('Postal Code');
                    $Company_CAR = $record->getField('Company');
                    $Notes_CAR = $record->getField('Notes');


    /* CAR Job Work Sheet */
                $service_date_carjobsheet = $record->getField('Service Date');
                $service_time = $record->getField('Service Time');
                $unit_time =  $record->getField('Unit_Time');
                $Technician_CAR =  $record->getField('Technician');
                $servicetype_CAR =  $record->getField('Service Type');
                $Factored_nonfactored =  $record->getField('Factored_Non_Factored');
                $key_register_hash =  $record->getField('Key_Register_ID_CJS');
                $work_order =  $record->getField('Work Order');
                $invoice_hash =  $record->getField('Invoice #');
                $CAR_hash =  $record->getField('CAR#');
    /* CAR Job Work Sheet */


    /* Total breakdown */
               $CAR_current_total =  $record->getField('Car_Current_Total');
               $CAR_invoice_value =  $record->getField('CAR Invoice Value');
               $TotalHours_Annual =  $record->getField('Total Hours AnnualModifiable');
               $CarQuotedPercentage =  $record->getField('%CARQUOTEDISCOUNTPERCENTAGE');
               $CarquoatedDiscount =  $record->getField('%CARQUOTEDISCOUNTVALUE');
               $Car_Discount_Total =  $record->getField('%CARQUOTEDISCOUNTTOTAL');
               $CAR_GST =  $record->getField('CAR GST Job');
               $CAR_Total_Job =  $record->getField('CAR Total Job');
    /* Total breakdown */

    /* Notes */
             $notes_details =  $record->getField('Notes');
             $tenant_details =  $record->getField('tenant details');
             $comments =  $record->getField('comments');
    /* Notes */

    /* Other Information */
             $completed_yn =  $record->getField('Completed Y/N');
             $manager_approval =  $record->getField('Manager Approval');
             $letter_sent =  $record->getField('letters sent');
             $letters_sentdateinfo =  $record->getField('Letters sent date');
             $textsent_info =  $record->getField('Text Sent');
             $textdate_info =  $record->getField('Text Date');
             $acceptedby =  $record->getField('Accepted By');
             $accepteddate =  $record->getField('Accepted Date');
             $sent_contractor =  $record->getField('Sent to Contractor');
             $contractor =  $record->getField('Contractor');
             $contractor_test =  $record->getField('Contractor Payment Test');

   /* Template Check */
           $template_check_text1 =  $record->getField('Template Check Text 1');
           $template_check_text2 =  $record->getField('Template Check Text 2');
           $template_check_text3 =  $record->getField('Template Check Text 3');
     }


}
?>

<!-- Get Highest Tax Invoice Num CAR -->


<!-- CAR Invoice Item Highest Record -->
<?php 
  $request_carinvoice_ID = $fm->newFindCommand('carinvoices_layout');
  $request_carinvoice_ID->addFindCriterion('invoice_type', "2");
  $request_carinvoice_ID->addSortRule('record_ID_info', 1, FILEMAKER_SORT_DESCEND);

 $request_carinvoice_ID->setRange(0, 1);
  $result_carinvoice_ID =  $request_carinvoice_ID->execute();
  if (FileMaker::isError( $result_carinvoice_ID ))
  {
  echo "<p>" .   $result_carinvoice_ID->getMessage() . "</p>";
  exit;
  }

$records_carinvoice_ID = $result_carinvoice_ID->getRecords();

foreach ($records_carinvoice_ID as $record_carinvoice_ID)
  {
    $carinvoice_ID_highest =  $record_carinvoice_ID->getField("record_ID_info") + 1;
  }

?>
<!-- CAR Invoice Item Highest Record -->







<!-- Get Highest Tax Invoice Num CAR -->


<!-- Get highest Job Record Number-->

<?php

  $request_latestjobnumber = $fm->newFindCommand('Carjobsheet');
  $request_latestjobnumber->addFindCriterion('Sheet Type', "2");
  $request_latestjobnumber->addSortRule('Job Number', 1, FILEMAKER_SORT_DESCEND);
  $request_latestjobnumber->setRange(0, 1);


  $result_latestnumber = $request_latestjobnumber->execute();
if (FileMaker::isError(  $result_latestnumber))
  {
  echo "<p>" .   $result_latestnumber->getMessage() . "</p>";
  exit;
  }
$records_latestnumber = $result_latestnumber->getRecords();
foreach ($records_latestnumber as $record_latestnumber)
  {
   $info_jobnumber_reschedule = $record_latestnumber->getField('Job Number');
  }
?>

<!-- Get highest ID (CAR Worksheet)-->

<?php

  $request_record_ID_CAR_worksheet = $fm->newFindCommand('Carjobsheet');
  $request_record_ID_CAR_worksheet->addSortRule('record_ID_information', 1, FILEMAKER_SORT_DESCEND);
  $request_record_ID_CAR_worksheet->setRange(0, 1);

  $result_latestnumber_ID_CAR = $request_record_ID_CAR_worksheet->execute();
if (FileMaker::isError(  $result_latestnumber_ID_CAR))
  {
  echo "<p>" .   $result_latestnumber_ID_CAR->getMessage() . "</p>";
  exit;
  }
$records_ID_CAR = $result_latestnumber_ID_CAR->getRecords();
foreach ($records_ID_CAR as $record_ID_CAR)
  {
   $info_ID_reschedule_CAR = $record_ID_CAR->getField('record_ID_information');
  }
?>



<!-- Highest Record ID CAR Worksheet -->

<?php 
  $request_latestCARworksheet_ID = $fm->newFindCommand('Carjobsheet');
  $request_latestCARworksheet_ID->addFindCriterion('Sheet Type', "2");
  $request_latestCARworksheet_ID->addSortRule('record_ID_information', 1, FILEMAKER_SORT_DESCEND);

  $request_latestCARworksheet_ID->setRange(0, 1);
  $request_latestCARworksheet_ID = $request_latestCARworksheet_ID->execute();
    if (FileMaker::isError($request_latestCARworksheet_ID)){
     echo "<p>" . $request_latestCARworksheet_ID->getMessage() . "</p>";
     exit;
    }

  $records_latestCARworksheet_ID = $request_latestCARworksheet_ID->getRecords();
  foreach ($records_latestCARworksheet_ID  as $record_latestCARworksheet_ID)
  {
   $infogather_recordID = $record_latestCARworksheet_ID->getField('record_ID_information') + 1;
  }
?>
<!-- Highest Record ID CAR Worksheet -->


<!DOCTYPE html>
<html>
<head>
    <title>Worksheet - Car Job Sheet</title>
<!-- Meta and Opengraph tags -->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Vincent Ramirez">
      <meta name="Phoenix Fire Protection" content="Phoenix Fire Protection v1.0">
      <meta name="keywords" content="material design, fixed header, responsive header, sidebar">
      <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- End Meta and Opengraph tags -->
<!-- Bootstrap and External CSS Links -->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:300'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href ="<?php echo base_url(); ?>css/phoenix_worksheet2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url(); ?>js/phoenix_ajax_code_CAR.js"></script>
    <script src="<?php echo base_url(); ?>js/phoenix_ajax_code_CAR2.js"></script>
<style>
  #titlemode h2 {
    position: absolute;
    top: -5px;
    left: 1040px;
    color: white;
  }
</style>


  </head>



<header>
<!-- Menu slider -->
<div class="header-inner clearfix">
    <div class="nav-btn nav-slider">
        <i class="material-icons">menu</i>
    </div>

<!-- End Menu slider -->
<!-- Header Logo -->
<div class="header-logo">
    <a href="#"><img alt="logo" src="<?php echo base_url('/img/logo_login.png'); ?>"></a>
      <ul class="ul-base">
        <li><a href="#"><img src="<?php echo base_url('/img/006-plus.png'); ?>"></a></li>
        <li><a href="#"><img src="<?php echo base_url('/img/005-minus.png'); ?>"></a></li>
        <li><a href="#"><img src="<?php echo base_url('/img/004-search.png'); ?>"></a></li>
        <li><a href="#"><img src="<?php echo base_url('/img/003-record.png'); ?>"></a></li>
        <li><a href="#"><img src="<?php echo base_url('/img/003-duplicate.png'); ?>"></a></li>
        <li><a href="#"><img src="<?php echo base_url('/img/001-file.png'); ?>"></a></li>
      </ul>
</div>
<!-- End Header Logo -->
<!-- Header Search -->
<div class="header-search">
    <div class="search">
        <i class="material-icons">search</i>
        <form action="Phoenix_contact_search" method="get" name="search_keywords" id="search" >
        <input type="search" name="search_int" id="search_real" class="searchtext" placeholder="Search" value="" onkeyup="enterinput(this)">
        <input type="text" name="search_int2" id="test_b" hidden/>
        </form>
    </div>
</div>

</div>

 <div id="titlemode">
          <h2>CAR Job Sheet</h2>
        </div>
</header>


 
<script>
  window.onload = function() {


     $("#deleteselectedrecords").attr("disabled", "disabled");

    /* Track Skip information */
       var info_num_skip = document.getElementById("track_skipinformation").value;
       localStorage.setItem("track_skip_information_detected", info_num_skip);
    /* Track Skip information */


    /* Job Number Information */
      var job_number_info = document.getElementById("infojob").value;
       localStorage.setItem("job_number_detected", job_number_info );
    /* Job Number Information */

    /* Latest Job Number Information */
    var total_new_record_info= document.getElementById("total_new_record").value;
    localStorage.setItem("total_record", total_new_record_info);
    /* Latest Job Number information */

      /* Stop Credit Information based */
    document.getElementById("stop_credit_information").value = localStorage.getItem("stopcredit_information");

    document.getElementById("siteID_stop_basis").value = localStorage.getItem("siteID_stopcredit_information");
     /* Stop credit Information based */


    /* Condition Basis (Contact management) */
    document.getElementById("information_category_contactmanagement").value = localStorage.getItem("information_category_condition");

    document.getElementById("information_record_skip_contactmanagement").value = localStorage.getItem("information_skip_condition");
    /* Conidtion Basis (Contact management) */


      /* Retainment Records when navigating to other modules (service worksheet) */
    document.getElementById("information_worksheet_type").value = localStorage.getItem("information_category_condition_serviceworksheet");

    document.getElementById("information_worksheet_skip_service").value = localStorage.getItem("information_skip_condition_serviceworksheet");
      /* Retainment Records when navigating to other modules (service worksheet) */


      /* Retainment Records when navigating to other modules (CAR worksheet) */
      var category_information_basis_CARworksheet = document.getElementById("information_carworksheet_type").value;
      localStorage.setItem("information_category_condition_CARworksheet", category_information_basis_CARworksheet);

      var record_information_basis_CARworksheet = document.getElementById("information_carworksheet_skip").value;
      localStorage.setItem("information_skip_condition_CARworksheet",  record_information_basis_CARworksheet);
       /* Retainment Records when navigating to other modules (CAR worksheet) */

  
    };


</script>




<body>
<!-- nav -->
<nav class="sidebar">
  <div class="nav-header">
    <div class="nav-search">
      <div class="search">
        <i class="material-icons">search</i>
        <input type="search" name="search" placeholder="Search">
      </div>
    </div>
  </div>

<ul class="nav-categories ul-base">
    <li>><a href="<?php echo site_url('Contactmanagement/main'); ?>"><img src="<?php echo base_url('/img/CAT1/006-add-contact.png'); ?>"> Contact</a></li>
    <li>><a href="<?php echo site_url('Worksheet/servicejob_sheet'); ?>"><img src="<?php echo base_url('/img/CAT1/005-piece-of-paper-and-pencil.png'); ?>"> Work Sheet</a></li>
    <li>><a href="<?php echo site_url('Quotation/main_service'); ?>"><img src="<?php echo base_url('/img/CAT1/003-sheet.png'); ?>"> Quotation</a></li>
    <li>><a href="<?php echo site_url('Template/main_service_template') ?>"><img src="<?php echo base_url('/img/CAT1/004-leaflet.png'); ?>"> Templates</a></li>
    <li>><a href="<?php echo site_url('Afss/main') ?>"><img src="<?php echo base_url('/img/CAT1/002-notebook.png'); ?>"> AFSS</a></li>
    <li>><a href="<?php echo site_url('Invoice/serviceinvoice_sheet') ?>"><img src="<?php echo base_url('/img/CAT1/001-invoice.png'); ?>"> Invoices</a></li>
    <li>><a href="<?php echo site_url('Reports/main') ?>"><img src="<?php echo base_url('/img/CAT2/005-newspaper.png'); ?>"> Reports</a></li>
  </ul>
<!-- Write date modified and created -->
<!-- End write date modified and created -->
</nav>
<form action="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" method="POST" name="search" id="search" >
<main role="main"></main>
  <div class="datecontainer">
    <label id="recordnumber"> Record <?php echo $current_record_num; ?> of <?php echo $found_record; ?></label>
    <label id="jobnumber">Job #: <?php echo $job_number_info; ?> </label>

       <!-- Information Stop Credit -->
        <input type="hidden" id="stop_credit_information" name="stop_credit_information" value=""/>
       <!-- Information Stop Credit -->

       <!-- Job Number Information -->
       <input type="text" id="infojob" name="info_job" value="<?php echo $job_number_info; ?>" hidden/>

         <!-- Job Number Information Reschedule, ADD, Duplicate -->
       <input type="text" id="information_job_latest" name="information_job_latest" value="<?php echo  $info_jobnumber_reschedule + 1;  ?>" hidden/>
         <!-- Job Number Information Reschedule, ADD, Duplicate -->

        <!-- Current Record Information -->
       <input type="text" id="info_recordNUMBER" name="record_information_a" value="<?php echo $record_IDinfo; ?>" hidden />
       <!-- Current Record Information -->

        <!-- Stop Credit information Site ID -->
         <input type="hidden" id="siteID_stop_basis" value=""/>
         <!-- Stop Credit Information Site ID -->

       <!-- Record ID current -->
       <input type="text" id="track_skipinformation" name="track_skipinformation" value="<?php echo $skip;  ?>" hidden/>
       <!-- Record ID current -->

       <!-- Record ID Highest information -->
      <input type="text" id="id_CARworksheet_ID" name="id_CARworksheet_ID" value="<?php echo  $infogather_recordID;  ?>" hidden/>
       <!-- Record ID Highest information -->

       <!-- ID Reschedule Job -->
       <input type="text" id="ID_reschedule" name="ID_reschedule" value="<?php echo  $info_ID_reschedule_CAR ?>" hidden/>
       <!-- ID Reschedule Job -->


       <!-- latest Add information -->
       <input type="text" id="total_new_record" name="total_new_record" value="<?php echo $total_new_record; ?>" hidden/>
       <!-- latest Add information -->


      <!-- Invoice CAR Sheet Tax Num Highest -->
      <input type="text" id="CAR_Invoice_ID_High" name="CAR_Invoice_ID_High" value="<?php echo $carinvoice_ID_highest ; ?>" hidden/>
      <!-- Invoice CAR Sheet Tax Num Highest -->

<!-- Retainment of Records (Contact Management) -->
    <input type="hidden" id="information_category_contactmanagement" name="information_category_contactmanagement" value=""/>

    <input type="hidden" id="information_record_skip_contactmanagement" name="information_record_skip_contactmanagement" value=""/>
<!-- Retainment of Records (Contact Management) -->


<!-- Retainment of Records (Service Worksheet) -->
 <input type="hidden" id="information_worksheet_type" name="information_worksheet_type" value=""/>
 <input type="hidden" id="information_worksheet_skip_service" name="information_worksheet_skip_service" value=""/>
<!-- Retainment of Records (Service Worksheet) -->


<!-- Retainment of Records (CAR Worksheet) -->
 <input type="hidden" id="information_carworksheet_type" name="information_carworksheet_type" value="<?php 
if (strpos($host, 'carjob_sheet') !== false) {
echo 'carjob_sheet';
}else if (strpos($host, 'infonumber_two') !== false) {
echo 'infonumber_two';
}?>"/>




 <input type="hidden" id="information_carworksheet_skip" name="information_carworksheet_skip" value="<?php echo $skip; ?>"/>
<!-- Retainment of Records (CAR Worksheet) -->






            <div class="panel panel-default">
      <div class="panel-heading">Date</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputdefault">Service Date</label>
                <input class="form-control" id="inputdefault_servicedate_carjobsheet" name="servicedate_carjobsheet" type="date"  value="<?php  


                if ($service_date_carjobsheet == ""){

             }else{
               echo date('Y-m-d',strtotime($service_date_carjobsheet));
             }


               

                ?>">


                 <script>
             $("#inputdefault_servicedate_carjobsheet").focusout(function(){

                var stop_credit_information_check = document.getElementById("stop_credit_information").value;

                var siteID_stopbasis_information_check =  document.getElementById("siteID_stop_basis").value;

                var current_ID_based = document.getElementById("inputdefault_siteID_carjobsheet").value;

              
                     if (stop_credit_information_check == "STOP" && siteID_stopbasis_information_check == current_ID_based){
                       $('#myModal_worksheetinformation_STOPCREDIT_message').modal('show');
                     }else{
                   
                     }
            
              });
            </script>

<!-- Service Date Information (Stop Credit Information) -->

<div class="modal fade" id="myModal_worksheetinformation_STOPCREDIT_message" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content add_move">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:black">Message</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent" style="color:black">This site is on stop credit due to overdue invoice. Please contact the client to determine payment details.</p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_stopcredit" data-value="0" style="position:absolute; top:9.5em; left:13em">Cancel</button>

          <button type="button" class="btn btn-default" data-dismiss="modal"  data-toggle="modal" data-target="#myModal_worksheetinformation_STOPCREDIT_message_password" id="ok_stopcredit" data-value="1" style="position:absolute; top:9.5em; left:19em">OK</button>
        </div>
      </div>

    </div>
  </div>
<!-- Modal Worksheet information (Stop Credit) -->
<!-- Modal Worksheet information (CAR Worksheet) -->
<div class="modal fade" id="myModal_worksheetinformation_STOPCREDIT_message_password" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content add_move">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:black">Please Enter your Password</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent" style="color:black"><input type="password" name="pasword_stopcredit" id="password_stopcredit" value=""/></p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default" id="ok_stopcredit_confirm" data-dismiss="modal" style="position:absolute; top:8.5em; left:19em">OK</button>

          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_stopcredit_confirm" style="position:absolute; top:8.5em; left:13em">Cancel</button>

         
        </div>
      </div>

    </div>
  </div>


<!-- Modal Worksheet information (CAR Worksheet) -->
<!-- Service Date Information (Stop Credit Information) -->

<input type="submit" name="omit_records_information" value="Omit Record"/>

<?php 
  if (isset($_POST['omit_records_information'])){
 





  }


?>

            </div>
            <div class="form-group">
                <label for="inputdefault">Time</label>
                <input class="form-control" id="inputdefault_time_carjobsheet" type="time" name="servicetime_carjobsheet"  value="<?php echo date('H:i',strtotime($service_time)); ?>">
            </div>
           <div class="form-group">
                <label for="inputdefault">Client Details</label>
                <input class="form-control" id="inputdefault_clientname_carjobsheet" type="text" name="clientname_carjobsheet"  value="<?php echo $Company_CAR; ?>">
            </div>
           <div class="form-group">
                <label for="inputdefault">Technician</label>
                <input class="form-control" id="inputdefault_technician_carjobsheet" list="names" name="name_technician_carjobsheet" value="<?php echo $Technician_CAR; ?>" name="name">
                    <datalist id="names">
                        <option value="Bruce">
                        <option value="Contractor">
                        <option value="Joe">
                        <option value="Mark">
                        <option value="Nathan">
                        <option value="Nathaniel">
                        <option value="Shaun">
                        <option value="Sydney Fire Danny">
                    </datalist>
            </div>
        </div>
     </div>
</div>
     <div class="servicecontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Service Type</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Service Type</label>
                <input class="form-control" id="inputdefault_servicetype_carjobsheet" name="inputdefault_servicetype_carjobsheet" list="service" name="name" value="<?php echo $servicetype_CAR;?>">
                    <datalist id="service">
                        <option value="Annual Service">
                        <option value="Bi-Annual Service">
                        <option value="Secondary Inspection">
                        <option value="Corrective Action">
                        <option value="Weekly Test">
                        <option value="Monthly Test">
                        <option value="WARRANTY">
                        <option value="Panel">
                        <option value="Quarterly">
                        <option value="Call Out">
                        <option value="Other">
                        <option value="Maintenance">
                        <option value="PUMP EAST">
                        <option value="PUMP WEST">
                        <option value="PUMP NORTH">
                        <option value="PUMP CITY">
                        <option value="PUMP SOUTH">
                        <option value="Installation">
                    </datalist>
                </div>
                <div class="form-group">
                <label for="inputdefault">CAR #:</label><a href="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/quotation/quote_number_CAR?carquotehash=<?php echo $CAR_hash; ?>" target="_blank"><img border="0" alt="Mail edit" src="<?php echo base_url('/img/forward.png'); ?>" width="18" height="18"></a>
                <input class="form-control" id="inputdefault_CARjobsheet" name="CARjobsheet_hash" type="text" value="<?php echo $CAR_hash; ?>">

                  <input type="button" id="btncss" name="sms_info" data-toggle="modal" data-target="#myModal_SMS" value="SMS" >
                </div>
            </div>
    </div>
</div>

<div id="myModal_SMS" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Template</h4>
      </div>
      <div class="modal-body">
        <ol>
          <li>CAR TEMPLATE <input type="checkbox" value="checked"><br><textarea cols="50" rows="5"><?php echo $template_check_text1; ?></textarea></li>
          <li>REMINDER TEMPLATE <input type="checkbox"><br><textarea cols="50" rows="5"><?php echo $template_check_text2; ?></textarea></li>
          <li><input type="checkbox"><br><textarea cols="50" rows="5">
            <?php echo $template_check_text3; ?> </textarea></li>
        </ol>
       

    <input type="button" value="Send" data-toggle="modal" data-target="#myModal_SMS2" data-dismiss="modal"/>

    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- SMS Send Number Information -->


<div id="myModal_SMS2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Template</h4>
      </div>
      <div class="modal-body">

     
    <input type="submit" value="Back" />

  <br>
  <br>
  <label>TO :</label><br>
  <textarea name="to" id="to" cols="30" rows="10">0414488778, 0411701554, 0412761229, 0419299666, 0412416336</textarea>
  <br>
  <label>MESSAGE :</label><br>
  <textarea name="message" id="message" cols="30" rows="10">IMPORTANT MESSAGE: We have recently been approved to undertake repairs to your unit as per the last fire inspection. Access to your unit is required on the 04/04/16 between 7am-12noon. Please reply YES immediately to confirm your availability or call 1300889301 to make other arrangements. Phoenix Fire Protection</textarea>
  <br>
  <label>STATUS</label><br>
  <textarea name="status" id="status" cols="30"></textarea><br>
  <input type="submit" value="Send SMS">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- SMS Send Number Information -->



<div class="workcontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Work Details</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Work Order No.</label>
                <input class="form-control" id="inputdefault_workorderno_carjobsheet" name="workorderno_carjobsheet" type="text" value="<?php echo $work_order; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Invoice #:<a href="http://armontsys.ddns.net/test%20site/phoenix_codeigniter/index.php/Invoice/number_two?taxinvoicenumber_CAR=<?php echo $invoice_hash; ?>" target="_blank">
                <img border="0" alt="Mail edit" src="<?php echo base_url('/img/forward.png'); ?>" width="18" height="18"></a></label>
                <input class="form-control" id="inputdefault_invoiceno_carjobsheet" name="invoiceno_carjobsheet" type="text" value="<?php echo $invoice_hash; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Completed Y / N</label>
                <input class="form-control" id="inputdefault_completedYN_carjobsheet" name="completedYN_carjobsheet" list="sent" name="name" value="<?php echo $completed_yn; ?>">
                    <datalist id="sent">
                        <option value="Yes">
                        <option value="No">
                        <option value="Other">
                    </datalist>
                </div>
                <div class="form-group">
                <label for="inputdefault">Manager Approval</label>
                <input class="form-control" id="inputdefault_managerapproval_carjobsheet" list="sent" name="name_managerapproval_carjobsheet" value="<?php echo $manager_approval; ?>">
                    <datalist id="sent">
                        <option value="Yes">
                        <option value="No">
                        <option value="Other">
                    </datalist>
                </div>
                <div class="form-group">
                <label for="inputdefault">Letters Sent</label>
                <input class="form-control" id="inputdefault_lettersent_carjobsheet" list="sent" name="name_lettersent_carjobsheet" value="<?php echo $letter_sent; ?>">
                    <datalist id="sent">
                        <option value="Yes">
                        <option value="No">
                        <option value="Other">
                    </datalist>
                </div>
                <div class="form-group">
                <label for="inputdefault">Letters Sent Date</label>
                <input class="form-control" id="inputdefault_sent_date_carjobsheet" name="name_letter_sent_date_carjobsheet"  type="date" value="<?php  



                if ($letters_sentdateinfo == ""){

              }else{
               echo date('Y-m-d',strtotime($letters_sentdateinfo));
              }





                 ?>">


                </div>
                <div class="form-group">
                <label for="inputdefault">Text Sent</label>
                <input class="form-control" id="inputdefault_textsent_carjobsheet" name="textsent_carjobsheet" type="text" value="<?php echo $textsent_info; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Text Date</label>
                <input class="form-control" id="inputdefault_textdate_carjobsheet" name="textdate_carjobsheet" type="date"  value="<?php 


                if ($textdate_info == ""){

              }else{
               echo date('Y-m-d',strtotime($textdate_info));
              }



                 ?>">


                </div>
                <div class="form-group">
                <label for="inputdefault">Accepted By</label>
                <input class="form-control" id="inputdefault_acceptedby_carjobsheet" name="acceptedby_carjobsheet" type="text" value="<?php echo $acceptedby; ?>">
                </div>
                <div class="form-group">

                <label for="inputdefault">Accepted Date</label>
                <input class="form-control" id="inputdefault_accepteddate_carjobsheet" name="accepteddate_carjobsheet" type="date" value="<?php 

   if ($accepteddate == ""){

              }else{
               echo date('Y-m-d',strtotime($accepteddate));;
              }


                 ?>">


                </div>
            </div>
    </div>
</div>

<div class="sitecontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Site Details</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Site ID<a href="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/Contactmanagement/selected_record?siteid=<?php echo $site_CAR; ?>" target="_blank">
                <img border="0" alt="Mail edit" src="<?php echo base_url('/img/forward.png'); ?>" width="18" height="18"></a>
                </label>
                <input class="form-control" id="inputdefault_siteID_carjobsheet" name="siteID_carjobsheet" type="text" value="<?php echo $site_CAR; ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">Strata Plan</label>
                <input class="form-control" id="inputdefault_strataplan_carjobsheet" name="strataplan_carjobsheet" type="text" value="<?php echo $strata_plan_CAR;?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Street</label>
                <input class="form-control" id="inputdefault_street_carjobsheet" name="street_carjobsheet" type="text" value="<?php echo $street_CAR; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">City</label>
                <input class="form-control" id="inputdefault_city_carjobsheet" name="city_carjobsheet" type="text" value="<?php echo $city_CAR; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Postal Code</label>
                <input class="form-control" id="inputdefault_postal_code_carjobsheet" name="postal_code_carjobsheet" type="text" value="<?php echo $postal_code_CAR; ?>">
                </div>
            </div>
    </div>
</div>

<div class="printcontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Print</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="printbtncontainer">
                      <ul class="pagination">
                        <li><a href="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/Worksheet/carjobsheet_report?jobnumber=<?php echo $job_number_info;  ?>" target="_blank">Print CAR Job Sheet</a></li>
                        <br>

                        <input type="button" id="create_letters" value="Create Letters" style="position:absolute; top:8em; left:4em;"/>


                      <!--  <li><a href="#" class="invoiceCAR_createexecute_letters">Create Letters</a></li> 


                      data-toggle="modal" data-target="#CAR_create_letters"

                      -->
                        <br>
                        <li><a href="#" data-toggle="modal" data-target="#RescheduleJob_Carjobsheet">Reschedule Job</a></li>
                        <br>

<!-- Script Information Create Letters -->
<script>


$("#create_letters").click(function(){

$checkbox = $(".lcheck").is(":checked");

if($checkbox == true) {
  $('#CAR_create_letters').modal('show');
} else {
  $('#CAR_Invoice_noselecteditems').modal('show');
}
});

</script>

<!-- Script Information Create Letters -->

                        <?php 
$request_viewbooking_verification = $fm->newFindCommand('Booking Sheet');
$request_viewbooking_verification->addFindCriterion('job_no', $job_number_info);

$result_booking_verification = $request_viewbooking_verification->execute();

if (FileMaker::isError($result_booking_verification))
  {
   echo '<li> <input type="button" class="booking_verify" name="viewbookingsheet" id="viewbookingsheet_empty" value="View Booking Sheet" onclick="function_determine()" style="color:white; background-color:#696969; position: absolute; top:10em; left:2.5em;"></li>';
  }else{
    echo '<li> <input type="button" class="booking_verify" name="viewbookingsheet" id="viewbookingsheet_exist" value="View Booking Sheet" onclick="function_determine()" style="color:yellow; background-color:#696969; position: absolute; top:10em; left:2.5em;"></li>';
  }


?>     
              </ul>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
  function function_determine(){
    if($('.booking_verify').prop('id')=='viewbookingsheet_empty')
{

$(document).ready(function() {
  $('#Booking_Sheet_Nomatch').modal('show');
});

}
else
{ 
   var str_num_job = document.getElementById("infojob").value;
   window.location.replace("http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/viewbooking_information?job_number=" + str_num_job );
}


  }


</script>

<!-- Create Letters Information -->
<script>
     $(document).ready(function() {

$(document).on('change', 'input:checkbox.lcheck', function(e) {
      if(this.checked) {
        $(this).closest("tr").toggleClass("selected");
        $(this).closest('tr').find('#parta_location').attr("name", "location[]");
        $(this).closest('tr').find('#parta_equipment').attr("name", "equipment[]");
        $(this).closest('tr').find('#partA_rectification').attr("name", "rectification[]");

      }else{
          $(this).closest('tr').find('#parta_location').removeAttr("name");
          $(this).closest('tr').find('#parta_equipment').removeAttr("name");
          $(this).closest('tr').find('#partA_rectification').removeAttr("name");
          $(this).closest("tr").removeClass("selected");
      }

})

});
</script>
<!-- Create Letters Information -->


<!-- Create Reschedule Job Information -->
<script>
     $(document).ready(function() {

         $('.partA_status').change(function(){
              $('#tablePARTA tr').click(function(event) {
                if (event.target.type !== 'checkbox') {
               $('.check_information_test:checkbox', this).trigger('click');
                }
              });
          });


          $(document).on('change', 'input:checkbox.check_information_test', function(e) {

             var target = $(this).closest('tr').find('.partA_status option:selected').val();

           if(this.checked && target == "N") {
             $(this).closest("tr").toggleClass("selected");
             $(this).closest('tr').find('#parta_location').attr("name", "location[]");
             $(this).closest('tr').find('#parta_equipment').attr("name", "equipment[]");
             $(this).closest('tr').find('#partA_rectification').attr("name", "rectification[]");
             $(this).closest('tr').find('#partA_fault').attr("name", "fault[]");
             $(this).closest('tr').find('#partA_contactdetails').attr("name", "contact_details[]");
             $(this).closest('tr').find('#partA_statusInformation_test').attr("name", "status_information_test[]");
             $(this).closest('tr').find('#partA_value').attr("name", "value[]");
             $(this).closest('tr').find('.check_information_test').attr("checked", "checked");

           }else{
             $(this).closest('tr').find('#parta_location').attr("name", "location_yes[]");
             $(this).closest('tr').find('#parta_equipment').attr("name", "equipment_yes[]");
             $(this).closest('tr').find('#partA_rectification').attr("name", "rectification_yes[]");
             $(this).closest('tr').find('#partA_fault').attr("name", "fault_yes[]");
             $(this).closest('tr').find('#partA_contactdetails').attr("name", "contact_details_yes[]");
             $(this).closest('tr').find('#partA_statusInformation_test').attr("name", "status_information_test_yes[]");
             $(this).closest('tr').find('#partA_value').attr("name", "value_yes[]");
               $(this).closest('tr').find('.check_information_test').attr("checked", "checked");






           }

          })
});


</script>
<!-- Create Reschedule Job Information -->




<!-- Reschedule Job Information -->

<div class="modal fade" id="RescheduleJob_Carjobsheet" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Reschedule Job Creation</h4>
    </div>
    <div class="modal-body">
      <h4>You are about to Reschedule all the items that has mark No. Are you sure you want to proceed? </h4>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="dissmiss__carjobsheet" data-dismiss="modal">No</button>
      <button type="submit" class="btn btn-primary" name="Apply_reschedulejob_information" id="Apply_reschedulejob_information">Yes</button>
    </div>
  </div>
</div>
</div>

<!-- Reschedule Job Information -->


<!-- Create Booking Sheet already exist Pop-up -->
<div class="modal fade" id="Booking_Sheet_Nomatch" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Booking Sheet Creation</h4>
    </div>
    <div class="modal-body">
      <h4>ERROR 401: No records match the request. Do you want to Create Booking Sheet for this Sheet?</h4>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" name="Apply_InformationBookingSheet" id="create_approval_invoice" value="Yes">
      <input type="submit" class="btn btn-primary" value="No"  data-dismiss="modal">
    </div>
  </div>
</div>
</div>

<?php
$info_job = (isset($_POST['info_job'])) ? $_POST['info_job'] : "";

$servicedate = (isset($_POST['servicedate_carjobsheet'])) ? $_POST['servicedate_carjobsheet'] : "";
$servicedate_revised = date('m/j/Y', strtotime($servicedate));
$timeinfo = (isset($_POST['servicetime_carjobsheet'])) ? $_POST['servicetime_carjobsheet'] : "";
$clientname_booking = (isset($_POST['clientname_carjobsheet'])) ? $_POST['clientname_carjobsheet'] : "";

if (isset($_POST['Apply_InformationBookingSheet'])) {

        $commandAdd_booksheet = $fm->newAddCommand("Booking Sheet");
        $commandAdd_booksheet->setField('service_date', $servicedate_revised);
        $commandAdd_booksheet->setField('service time', $timeinfo);
        $commandAdd_booksheet->setField('car_no', "");
        $commandAdd_booksheet->setField('job_no', $info_job);
        $commandAdd_booksheet->setField('company', $clientname_booking);

  $result_booksheet = $commandAdd_booksheet->execute();

  if (FileMaker::isError($result_booksheet)) {
    echo '<script>alert("'.$result_booksheet->getMessage().'");</script>';
    exit;
  }else{
    echo'<script>

     var str_num_job = localStorage.getItem("job_number_detected");

     window.location.replace("http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/viewbooking_information?job_number=" + str_num_job );</script>';

  }


}


?>


<!-- Create Letters Pop-up  -->
<div class="modal fade" id="CAR_create_letters" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">CAR Invoice Creation</h4>
  </div>
  <div class="modal-body">
    <h4>Are you sure you want to Create Letters?</h4>
  </div>
  <div class="modal-footer">

    <input type="submit"  class="btn btn-default" id="btncss" name="add_letters_operation"  value="Yes" >
    <button type="button" class="btn btn-danger" id="dismiss_approval_invoice" data-dismiss="modal">No</button>
  </div>
</div>
</div>
</div>

<!-- Create Letters Pop-up -->
<!-- Create Letters Pop-up  No Selected  -->

<div class="modal fade" id="CAR_Invoice_noselecteditems" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Job Invoice Creation</h4>
    </div>
    <div class="modal-body">
      <h4>No selected items to Create Letters: Please Select first.</h4>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
    </div>
  </div>
</div>
</div>
<!-- Create Letters Pop-up No Selected  -->



<div class="carcontainer">
    <div class="panel panel-default">
        <div class="panel-heading">CAR Details</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">CAR Current Total EX : </label>
                <input class="form-control" id="inputdefault_carcurrent" name="carcurrent" type="text" value="<?php echo '$' . number_format($CAR_current_total, 2);?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">CAR Invoice Value : </label>
                <input class="form-control" id="inputdefault_carInvoicevalue" name="car_invoice" type="text" value="<?php echo '$' . number_format($CAR_invoice_value, 2); ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">Hours : </label>
                <input class="form-control" id="inputdefault_hours" type="text" name="car_hours" value="<?php echo $TotalHours_Annual; ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">Discount %</label>
                <input class="form-control" id="inputdefault_discountCAR" name="discountCAR" type="text" value="<?php echo $CarQuotedPercentage;  ?>" oninput="calculate()">
                </div>
                <div class="form-group">
                <label for="inputdefault">Discount Value : </label>
                <input class="form-control" id="inputdefault_discountvalue" name="discountvalue" type="text" value="<?php echo '$' . number_format($CarquoatedDiscount, 2);  ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">Subtotal : </label>
                <input class="form-control" id="inputdefault_subtotalCAR" name="subtotalCAR" type="text" value="<?php echo '$' . number_format($Car_Discount_Total, 2); ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">CAR GST : </label>
                <input class="form-control" id="inputdefault_CARGST" name="CARGST" type="text" value="<?php echo '$' . number_format($CAR_GST, 2); ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputdefault">CAR Total : </label>
                <input class="form-control" id="inputdefault_cartotal" name="cartotal" type="text" value="<?php echo '$' . number_format($CAR_Total_Job); ?>" readonly>

                </div>

                <div class="form-group">
                    <label for="inputdefault">Material Cost: </label>
                    <input type="text" class="form-control" name="materialcost" id="materialcost" style="background-color:#EEEEEE" readonly>
                </div>

                <div class="form-group">
                    <label for="inputdefault">JODAN Payment </label>
                    <input type="text" class="form-control" name="jodanpayment" id="jodanpayment" style="background-color:#EEEEEE" readonly>
                </div>

            </div>
    </div>
</div>

<div class="btncrep">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="buttoncrep">
               <input type="submit" id="btncsscrep" class="invoiceCAR_createexecute" name="CAR_invoice_submit_information" value="Create CAR Invoice" />
                <br>
                <button id="btncsscrep" type="button"><a href="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/Worksheet/carworkorder_report?jobnumber=<?php echo $job_number_info;  ?>" target="_blank">Print Work Order</a></button>
            </div>
        </div>
    </div>
</div>




    <!-- Create Job Invoice modal Pop-up -->
  <div class="modal fade" id="CAR_Invoice" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">CAR Invoice Creation</h4>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to Create Invoice for CAR Job Sheet?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="create_approval_invoice" data-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-primary" id="dismiss_approval_invoice" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

    <!-- Create Job Invoice Modal Pop-up -->


    <!-- Create Job Invoice modal Selection of Factor Pop-up -->
  <div class="modal fade" id="CAR_Invoice_selection" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="close_factorselection" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Job Invoice Creation</h4>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to Create Invoice for CAR Job Sheet?</h4>
      </div>
      <div class="modal-footer">

        <input type="submit" class="btn btn-default" name="Factored_information" id="Factored_information" value="Factored">
        <input type="submit" class="btn btn-primary" name="Non_Factored_information" id="Non_Factored_information" value="Non-Factored">

      </div>
    </div>
  </div>
</div>

    <!-- Create Job Invoice modal Selection of Factor Pop-up  -->

    <!-- Job Invoice Notice -->

    <div class="modal fade" id="CAR_Invoice_alreadycreated" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Job Invoice Creation</h4>
        </div>
        <div class="modal-body">
          <h4>This Service Job Sheet has already created a CAR Sheet Invoice</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>



<div class="btnsheet">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="button">
                <button id="btncss" type="button"><a href="" id="servicejob_link">SERVICE JOB SHEET</a></button>
                <button id="btncss" type="button"><a href="" id="carjoblink">CAR JOB SHEET</a></button>
                <button id="btncss" type="button"><a href="http://armontsys.ddns.net/Test%20Site/phoenix_codeigniter/index.php/Worksheet/installjob_sheet">INSTALL SHEET</a></button>
            </div>
        </div>
    </div>
</div>



<!-- Link Information detected -->
<script>

/* Service Link basis */

$("#servicejob_link").on('click', function() {

var category_serviceworksheet_information_criteria = document.getElementById("information_worksheet_type").value;

var information_serviceworksheet_skip_criteria = document.getElementById("information_worksheet_skip_service").value;

if (category_serviceworksheet_information_criteria == "servicejob_sheet"){

    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/servicejob_sheet?skip=" + information_serviceworksheet_skip_criteria + "&max=1";

  }else if (category_serviceworksheet_information_criteria == "infonumber_one"){

    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/infonumber_one?skip=" + information_serviceworksheet_skip_criteria + "&max=1";
  }

  return false;
});

/* Service Link basis */

/* CAR Link basis */

$("#carjoblink").on('click', function() {

var category_CAR_information_criteria = document.getElementById("information_carworksheet_type").value;

var information_CAR_skip_criteria = document.getElementById("information_carworksheet_skip").value;

if (category_CAR_information_criteria == "carjob_sheet"){

    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet?skip=" + information_CAR_skip_criteria + "&max=1";

  }else if (information_CAR_skip_criteria == "infonumber_two"){

    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/infonumber_two?skip=" + information_CAR_skip_criteria + "&max=1";
  }

  return false;
});

/* Car Link basis */


</script>

<!-- Link Information detected -->



<?php
    $record_showInformation_FireCoEmail = $fm->getRecordByID("Carjobsheet", $record_IDinfo);
    $related_FireCoEmail = $record_showInformation_FireCoEmail->getRelatedSet('Fire Co Email Add for CAR Job Sheet');

    if (!FileMaker::iserror ($related_FireCoEmail)) {
      foreach($related_FireCoEmail as $related_record_FireCoEmail)
        {
          $email_fireco =  $related_record_FireCoEmail->getField('Fire Co Email Add for CAR Job Sheet::Email');
          $fireco_email_1 =  $related_record_FireCoEmail->getField('Fire Co Email Add for CAR Job Sheet::Fire Co Email');
        }
      }
  ?>


<div class="emailcontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Email</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Email : </label>
                <input class="form-control" id="inputdefault_email_carjobsheet" name="email_carjobsheet" type="text" value="<?php echo $email_fireco; ?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Fire Co. Email :<a href="#">
                <a href="#" id="edit_body_information_CAR" data-toggle="modal" data-target="#myModal_edit_mailinformation_CAR"><img border="0" alt="Mail edit" src="<?php echo base_url('/img/002-mail.png'); ?>" width="18" height="18"></a>
              <input type="submit" name="car_submit_email" value="send"/>  <!-- <a href="#" id="edit_send_infromation_CAR"><img border="0" alt="Mail send" src="<?php echo base_url('/img/001-mail-1.png'); ?>" width="18" height="18"></a> -->
                </label>
                <input class="form-control" id="inputdefault_email_fireco_carjobsheet" name="email_fireco_carjobsheet" type="text" value="<?php echo $fireco_email_1; ?>">
                </div>
            </div>
    </div>
</div>



<div class="modal fade" id="myModal_edit_mailinformation_CAR" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content add_move">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black">Edit Body Message (CAR JOB SHEET)</h4>
      </div>
      <div class="modal-body">
        <textarea id="edit_information_whole_CAR" name="edit_information_whole_CAR" rows="20" cols="60">
Dear Valued Client,

As per your acceptance of Corrective Action Quotatio Number <?php echo $CAR_hash; ?>, we have scheduled these works to be completed on <?php  echo date('l, j F, Y',strtotime($service_date_carjobsheet)); ?>.

We have advised all releveant residents of our rectification date and requested they contact our office to arrange an appointment time. Any other persons that must be notificed of our insepction
dates must be notified by strata unless other arrangements have been made for us to do so.

If no contact is made by the tenants regarding their repair for the scheduled date, the inspection will be cancelled and rescheduled for another date and time.

Tenants are notified by way of SMS where a mobile number has been given or mail for all other instances.

All bookings made by tenants will incur a $49.50 service charge if they are not there when the technicians attend.

Please advise if these arrangements are not suitable as a matter of priority.

Kindest regards,

Service Team
Phoenix Fire  and Maintenance Pty Ltd
P: 02 9670 4058
F: 02 9670 4078
E: service@pfam.com.au

</textarea>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-primary" name="" id="save_draft_information"  data-dismiss="modal"  value="OK">
      </div>
    </div>

  </div>
</div>


<?php

if (isset($_POST['car_submit_email'])){
  $email = "jamescv31@gmail.com";
                   $password = "Valdeavilla7";
                   $to_id = $_POST['email_fireco_carjobsheet'];
                   $message = $_POST['edit_information_whole_CAR'];
                   $subject = $_POST['strataplan_carjobsheet'] . "  " . $_POST['street_carjobsheet'] . "  " .  $_POST['city_carjobsheet'] . " " . $_POST['info_job'];


$mail = new PHPMailer();
$mail->isSMTP(true); // telling the class to use SMTP
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->SMTPSecure = 'tls';
$mail->Host = 'tls://smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username =  $email ; // SMTP username
$mail->Password = $password ; // SMTP password
// TCP port to connect to
// $mail->SMTPDebug = 1;
$mail->setFrom($email );
$mail->AddAddress($to_id);
$mail->Subject =  $subject;
$mail->Body = $message;
$mail->WordWrap = 70;
if (!$mail->send()) {
                      $error = "Mailer Error: " . $mail->ErrorInfo;
                       ?><script>alert('<?php echo $error ?>');</script><?php
                   }
                   else {
                      echo '<script>alert("Message sent!");</script>';
                   }




}


?>




<div class="keycontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Key</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Key Register ID</label>
                <input class="form-control" id="inputdefault_keyregisterID_CAR" name="keyregisterID_CAR" type="text" value="<?php echo $key_register_hash;?>">
                </div>
                <div class="form-group">
                <label for="inputdefault">Factored/Non</label>
                <input class="form-control" id="inputdefault_factorednon_CAR" name="factorednon_CAR" type="text" value="<?php echo $Factored_nonfactored; ?>">
                </div>
            </div>
    </div>
</div>
<div class="contractorcontainer">
    <div class="panel panel-default">
        <div class="panel-heading">Sent</div>
            <div class="panel-body">
                <div class="form-group">
                <label for="inputdefault">Sent to Contractor</label>
                <input class="form-control" id="inputdefault_senttocontractor_CAR" name="senttocontractor_CAR" type="date" value="<?php



  if ($sent_contractor == ""){

              }else{
               echo date('Y-m-d',strtotime($sent_contractor));
              }




                 ?>">
               
                <input class="form-control" id="inputdefault_contractor_CAR" name="contractor_CAR" type="text" value="<?php echo $contractor;?>">
                </div>
            </div>
    </div>
</div>


<div class="tcontainer">
    <div class="panel panel-default">
        <div class="panel-body">
     
                <div class="form-group"><br>
                <label for="comment">Additional Notes</label>
                <textarea placeholder="Place additional notes here" class="form-control" rows="5" id="comment_additionalnotes_CAR" name="additionalnotes_CAR_copy"><?php echo $notes_details; ?></textarea>
                </div>
    
                <div class="form-group">
                <label for="comment">Tenant Details</label>
                <textarea placeholder="Place tenant details here" class="form-control" rows="5" id="comment_tenantdetails_CAR" name="tenantdetails_CAR_copy"><?php echo $tenant_details; ?></textarea>
                </div>
 
     
                <div class="form-group">
                <label for="comment">Comments</label>
                <textarea placeholder="Place tenant details here" class="form-control" rows="5" id="comment_CAR" name="comment_CAR_copy"><?php echo $comments; ?></textarea>
                </div>

        </div>
    </div>
</div>

<div class="ncontainer">
    <ul class="pagination">
     <li><a id="first_record" href="<?php echo $first_record; ?>">First</a></li>
     <li><a id="previous_three_record" href="<?php echo  $previous_record_three;  ?>">  << </a></li>
     <li><a id="previous_record" href="<?php echo  $previous_record; ?>">Back</a></li>
     <li><a id="next_record" href="<?php echo  $next_record; ?>">Next</a></li>
     <li><a id="next_record_three" href="<?php echo  $next_record_three; ?>">>></a></li>
     <li><a id="last_record" href="<?php echo  $last_record; ?>">Last</a></li>
     <li><a href="http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet_list">View In List</a></li>
 </ul>
</div>
<style>

   #first_record[disabled] {
  pointer-events: none;
  cursor: default;
  color: white;
  background-color: gray;
}

#previous_three_record[disabled] {
pointer-events: none;
cursor: default;
color: white;
background-color: gray;
}

#previous_record[disabled] {
pointer-events: none;
cursor: default;
color: white;
background-color: gray;
}


#next_record[disabled] {
pointer-events: none;
cursor: default;
color: white;
background-color: gray;
}

#next_record_three[disabled] {
pointer-events: none;
cursor: default;
color: white;
background-color: gray;
}

#last_record[disabled] {
pointer-events: none;
cursor: default;
color: white;
background-color: gray;
}
   </style>

 <?php
   if ($currentRecord == "1") {
     echo '<script>


   $("#first_record").attr("disabled", "");
   $("#previous_three_record").attr("disabled", "");
   $("#previous_record").attr("disabled", "");
     </script>';
   }else if($currentRecord == "2") {
     echo '<script>
   $("#first_record").attr("disabled", "");
   $("#previous_three_record").attr("disabled", "");
     </script>';
   }else if($currentRecord == "3") {
     echo '<script>
   $("#previous_three_record").attr("disabled", "");
     </script>';
   }
   else if ($currentRecord == $total_last_record - 1){

     echo '<script>
   $("#next_record_three").attr("disabled", "");
     </script>';
   }

       else if ($currentRecord == $total_last_record){

         echo '<script>
       $("#next_record_three").attr("disabled", "");
       $("#last_record").attr("disabled", "");
         </script>';
       }


   else if ($currentRecord == $total_last_record + 1){

     echo '<script>
   $("#next_record").attr("disabled", "");
   $("#next_record_three").attr("disabled", "");
   $("#last_record").attr("disabled", "");
     </script>';
   }
   ?>

<script>
function checkTextField_carworksheet(field) {
    if (field.value == '') {
       $("#test_result_CAR").css("display", "none");
    }
}
</script>


<script>
function checkTextField_carworksheet_2(field) {
    if (field.value == '') {
       $("#test_result_CAR_2").css("display", "none");
    }
}
</script>

<div id="exTab3" class="container">
        <ul class="nav nav-pills">
            <li class="active"><a href="#1b" data-toggle="tab">Part A</a></li>
            <li><a href="#2b" data-toggle="tab">Part B</a></li>
        </ul>
   <div class="tab-content clearfix">
        <div class="tab-pane active" id="1b">
             <?php
              $record_parta = $fm->getRecordByID("carjob_information_A", $record_IDinfo);
              $related_records_parta = $record_parta->getRelatedSet('CAR Job Sheet Items');

              $table_data_parta  = '<div id="tablepartA_carjobsheet">';
              $table_data_parta .= '<table id="tablePARTA" border="1">';
              $table_data_parta .= '<thead>';
              $table_data_parta .= '<tr class="trtabparta">';
              $table_data_parta .= '<th class="headertabth_parta" id="hastadjust">#</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="Badjust">B</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="Ladjust" >L</th>';
              $table_data_parta .= '<th class="headertabth_parta">Code</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="locationadjust">Location</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="locationadjust">Equipment</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="faultadjust">Fault</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="reciticationadjust">Rectification</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="conactdetails_adjust">Contact Details</th>';
              $table_data_parta .= '<th class="headertabth_parta">Status</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="yncompletelbl">Y/N</th>';
              $table_data_parta .= '<th class="headertabth_parta" id="yncompletelbl">Value</th>';
              $table_data_parta .= '</tr>';
              $table_data_parta .= '</thead>';
              $table_data_parta .= '<tbody>';


              if (!FileMaker::iserror ($related_records_parta)) {
                foreach($related_records_parta as $related_record_parta)
                {
                  @$num_parta = $num_parta + 1;

                  $table_data_parta .= '<tr class="trtabparta">';
                  $table_data_parta .= '<td>' . $num_parta . '</td>';
                  $table_data_parta .= '<td>' . '<input type="checkbox" name="bookcheck" class="bcheck"/>' . '</td>';

                  $table_data_parta .= '<td>' . '<input type="checkbox" name="letterscheck[]" value="1" class="lcheck"/>' . '<input type="checkbox" name="hidden_check[]" value="1" class="check_information_test" hidden/>' . '</td>';

                   $table_data_parta .= '<td>


          <input type="text" id="parta_code" class="parta_code_info" value="' . $related_record_parta->getField('CAR Job Sheet Items::code') . '" name="code_invoice[]" list="codes_CAR" placeholder="Enter Code" onblur="checkTextField_carworksheet(this);"/>
                <datalist id = "codes_CAR">';
                ?>

                 <?php
                   $table_data_parta .= '
                    <div class="signal_CAR"></div>
                      <div class="search_box_CAR">
                        <div id="test_result_CAR" style="display:none">';
               
                   $table_data_parta .= '</div> </div>';
                 ?>

          <?php          
            $table_data_parta .=  '</datalist></td>';

                /*
                   $table_data_parta .= '<td>' . '<input type="text" name="code_invoice[]"  id="parta_code" class="parta_location" value="'.  $related_record_parta->getField('CAR Job Sheet Items::code') . '" />' . '</td>';

                */

                  $table_data_parta .= '<td>' . '<input type="text" name="location_invoice[]"  id="parta_location" class="parta_location" value="'. $related_record_parta->getField('CAR Job Sheet Items::location') . '" />' . '</td>';

                  $table_data_parta .= '<td> ' .'<input type="text" name="" id="parta_equipment" class="parta_equipment" value="'.  $related_record_parta->getField('CAR Job Sheet Items::equipment') . '" />' . '</td>';

                  $table_data_parta .= '<td>' . '<input type="text"  id="partA_fault" class="partA_fault" value="'. $related_record_parta->getField('CAR Job Sheet Items::fault') . '" />' . '</td>';

                  $table_data_parta .= '<td>' .'<input type="text"  name="description_invoice[]" id="partA_rectification" class="partA_rectification"  value="'. $related_record_parta->getField('CAR Job Sheet Items::rectification') . '" />' . '</td>';

                  $table_data_parta .= '<td>' . '<input type="text"  id="partA_contactdetails" class="partA_contactdetails" value="'. $related_record_parta->getField('CAR Job Sheet Items::contact_details') . '" />' . '</td>';

                  $table_data_parta .= '<td>' . '<input type="text"  id="partA_statusInformation_test" class="partA_statusInformation_test" value="'.  $related_record_parta->getField('CAR Job Sheet Items::Status') . '" />' . '</td>';

                  $table_data_parta .= '<td><select id="partA_statusInformation" name="status_b[]" class="partA_status" >'   . '<option value="' . $related_record_parta->getField('CAR Job Sheet Items::complete_yn') . '">' .  $related_record_parta->getField('CAR Job Sheet Items::complete_yn') . '</option><option value="Y">Y</option><option value="N">N</option></select></td>';

                  $table_data_parta .= '<td>' . '<input type="text" name="amount_invoice[]"  id="partA_value" class="partA_value"  value="'. $related_record_parta->getField('CAR Job Sheet Items::value') . '" />' . '</td>';

                  $table_data_parta .= '<td><input type="hidden" name="valuehidden" /></td>';

                   $table_data_parta .= '<td><input type="checkbox" class="select_update_delete_CAR_portal" /></td>';

                    $table_data_parta .= '<td><input type="hidden" id="record_information_productID" value="' . $related_record_parta->getRecordId() . '" readonly/></td>';


                  $table_data_parta .= '</tr>';
                }
                    }
                  $table_data_parta .= '<tr>
                <td colspan="5">
                    Value Total: $<span id="grandtotal"></span>
                </td>
            </tr>';

                  $table_data_parta .= '</tbody>';
                  $table_data_parta .= '</table>';
                  $table_data_parta .= '</div>';
                  ?>
                  <?php echo $table_data_parta ; ?>
          </div>

           <div class="tab-pane" id="2b">
             <?php

              $record_partb = $fm->getRecordByID("carjob_information_B", $record_IDinfo);
              $related_records_partb = $record_partb->getRelatedSet('CAR Job Sheet Items');
              $table_data_partb = '<div id="partB_information">';
              $table_data_partb .= '<table id="tablePARTB" border="1">';
              $table_data_partb .= '<thead>';
              $table_data_partb .= '<tr class="trtabpartb">';
              $table_data_partb .= '<th class="headertabth_partb" id="hashnum">#</th>';
              $table_data_partb .= '<th class="headertabth_partb" id="Barcodedjust" >Barcode</th>';
              $table_data_partb .= '<th class="headertabth_partb" id="phoenixadjust" >Phoenix Product Code</th>';
              $table_data_partb .= '<th class="headertabth_partb">CPWM New</th>';
              $table_data_partb .= '<th class="headertabth_partb">CPWM</th>';
              $table_data_partb .= '<th class="headertabth_partb">CPNM</th>';
              $table_data_partb .= '<th class="headertabth_partb">On Cost</th>';
              $table_data_partb .= '<th class="headertabth_partb">COG</th>';
              $table_data_partb .= '<th class="headertabth_partb">COG Hidden</th>';
              $table_data_partb .= '<th class="headertabth_partb">Cost Total</th>';
              $table_data_partb .= '<th class="headertabth_partb">Time</th>';
              $table_data_partb .= '</tr>';
              $table_data_partb .= '</thead>';
              $table_data_partb .= '<tbody>';
          if (!FileMaker::iserror ($related_records_partb)) {
              foreach($related_records_partb as $related_record_partb)
                      {
                      $carjobsheet_PARTB_barcode= $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsBarCode');
                      $carjobsheet_PARTB_phoenixproductcode= $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsPhoenixProductCode');


                      @$num_partb = $num_partb + 1;
                      $table_data_partb .= '<tr>';
                      $table_data_partb .= '<td>' . $num_partb . '</td>';

                      $table_data_partb .= '<td><input type="text" id="partb_barcode" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsBarCode') .'"/></td>';


                      $table_data_partb .= '<td>


          <input type="text" id="partb_phoenixproductcode" class="partb_phoenixproductcode_info" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsPhoenixProductCode') . '" name="barcode[]" list="codes_CAR_2" placeholder="Enter Code" onblur="checkTextField_carworksheet_2(this);"/>
                <datalist id = "codes_CAR_2">';
                ?>

                 <?php
                   $table_data_partb .= '
                    <div class="signal_CAR_2"></div>
                      <div class="search_box_CAR_2">
                        <div id="test_result_CAR_2" style="display:none">';
               
                   $table_data_partb .= '</div> </div>';
                 ?>

          <?php          
            $table_data_partb .=  '</datalist></td>';


/*
                      $table_data_partb .= '<td><input type="text" id="partb_phoenixproductcode" name="barcode" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsPhoenixProductCode') .'"/></td>';
*/
                      $table_data_partb .= '<td><input type="text" id="partb_CPWMnew" name="cpwmnew" value="' . $related_record_partb->getField('CAR Job Sheet Items::CPWM_NEW') .'"/></td>';

                      $table_data_partb .= '<td><input type="text" id="PARTB_CPWM" class="PARTB_CPWM" name="cpwm" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsCPWM') .'"/></td>';

                      $table_data_partb .= '<td><input type="text" id="PARTB_CPNM" class="PARTB_CPNM" name="cpnm" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsCPNM') .'"/></td>';

                      $table_data_partb .= '<td><input type="text" id="PARTB_Oncost" class="PARTB_Oncost" name="oncost" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsOnCost') .'"/></td>';

                      $table_data_partb .= '<td><input type="text" id="PARTB_COG" class="PARTB_COG" name="cog" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsCOG') .'"/></td>';

                      $table_data_partb .= ' <td><input type="text" name="coghidden" /></td>';

                      $table_data_partb .= '<td><input type="text" name="costtotal" class="PARTB_Costtotal" id="PARTB_Costtotal" name="costtotal" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsCostTotal') .'"/></td>';

                      $table_data_partb .= '<td><input type="text" id="PARTB_Time" class="PARTB_Time" name="time" oninput="calculate()" value="' . $related_record_partb->getField('CAR Job Sheet Items::carJobSheetItemsTime') .'"/></td>';

                      $table_data_partb .= '<td><input type="hidden" name="timehidden" /></td>';


                      $table_data_partb .= '<td><input type="checkbox" class="select_update_delete_CAR_portal2" /></td>';


                      $table_data_partb .= '<td><input type="hidden" id="recordID_partB" value="'. $related_record_partb->getRecordId() .'"/></td>';


                      $table_data_partb .= '</tr>';
                  }
              }
              $table_data_partb .= '<tr>
                <td colspan="5">
                    COG: <span id="subtotal"></span>
                </td>
            </tr>
                <tr>
                    <td colspan="5">
                        Time: <span id="subtotal2"></span>
                    </td>
                </tr>';
              $table_data_partb .= '</tbody>';
              $table_data_partb .= '</table>';
              $table_data_partb .= '</div>';
              ?>
              <?php echo $table_data_partb ; ?>

          </div>
          <input type="submit" name="delete_portal_CAR" id="deleteselectedrecords" class="deleteselectedrecords" value="Delete Selected Rows"  style="color:black"/>
          <input type="button" id="addselectedrows" value="Add Rows" style="color:black"/>
   </div>

</div>
<!-- CRUD Information -->

<script>
$(document).ready(function() {
$(document).on('change', 'input:checkbox.select_update_delete_CAR_portal', function(e) {


                    if(this.checked) {
                      $(this).closest("tr").toggleClass("selected");
                      $(this).closest('tr').find('#record_information_productID').attr("name", "update_delete_ID_record_CAR[]");
                      $(this).closest('tr').find('#parta_code').attr("name", "parta_code_CAR[]");
                      $(this).closest('tr').find('#parta_location').attr("name", "parta_location_CAR[]");
                      $(this).closest('tr').find('#parta_equipment').attr("name", "parta_equipment_CAR[]");
                      $(this).closest('tr').find('#partA_fault').attr("name", "parta_fault_CAR[]");
                      $(this).closest('tr').find('#partA_rectification').attr("name", "parta_rectification_CAR[]");
                      $(this).closest('tr').find('#partA_contactdetails').attr("name", "parta_contactdetails_CAR[]");
                      $(this).closest('tr').find('#partA_statusInformation_test').attr("name", "parta_statusinformation_test_CAR[]");
                      $(this).closest('tr').find('#partA_statusInformation').attr("name", "parta_statusinformation_CAR[]");
                      $(this).closest('tr').find('#partA_value').attr("name", "parta_value_CAR[]");
                  }else{
                      $(this).closest("tr").removeClass("selected");
                      $(this).closest('tr').find('#recordpartA_ID').removeAttr("name");
                      $(this).closest('tr').find('#parta_code').removeAttr("name");
                      $(this).closest('tr').find('#parta_location').removeAttr("name");
                      $(this).closest('tr').find('#parta_equipment').removeAttr("name");
                      $(this).closest('tr').find('#partA_fault').removeAttr("name");
                      $(this).closest('tr').find('#partA_rectification').removeAttr("name");
                      $(this).closest('tr').find('#partA_contactdetails').removeAttr("name");
                      $(this).closest('tr').find('#partA_statusInformation_test').removeAttr("name");
                      $(this).closest('tr').find('#partA_statusInformation').removeAttr("name");
                      $(this).closest('tr').find('#partA_value').removeAttr("name");
            

                  }

   })



});
</script>


<!-- Computation based -->

<script>

$(document).ready(function () {
 $("table#tablePARTA").on("change", 'input.partA_value', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
        calculate();
    });

    $("table#tablePARTB").on("change", 'input[name^="cpwmnew"], input[name^="cpwm"], input[name^="cpnm"], input[name^="oncost"], input[name^="cog"], input[name^="costtotal"], input[name^="time"]', function (event) {
        calculateRow2($(this).closest("tr"));
        calculateGrandTotal2();
        calculate()
    });
    

});




function calculateRow(row) {
    var value = +row.find('input.partA_value').val();
    // var valuehidden = +row.find('input[name^="valuehidden"]').val();
    row.find('input[name^="valuehidden"]').val((value * 1).toFixed(2));
}
    
function calculateGrandTotal() {
    var grandTotal = 0;
    $("table#tablePARTA").find('input[name^="valuehidden"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
    // $("#amounthidden").text(grandTotal.toFixed(2));
    // var amounthidden = document.getElementById('amounthidden');
    // var amounthiddenCalc = parseFloat(grandTotal);
    // amounthidden.value = amounthiddenCalc.toFixed(2);

}



function calculateRow2(row) {
    var cog = +row.find('input.PARTB_COG').val();
    // var valuehidden = +row.find('input[name^="valuehidden"]').val();
    row.find('input[name^="coghidden"]').val((cog * 1).toFixed(2));

    var time = +row.find('input.PARTB_Time').val();
    // var valuehidden = +row.find('input[name^="valuehidden"]').val();
    row.find('input[name^="timehidden"]').val((time * 1).toFixed(2));
}

function calculateGrandTotal2() {
   var grandTotal2 = 0;
    $("table#tablePARTB").find('input[name^="coghidden"]').each(function () {
        grandTotal2 += +$(this).val();
    });
    $("#subtotal").text(grandTotal2.toFixed(2));

     var grandTotal3 = 0;
    $("table#tablePARTB").find('input[name^="timehidden"]').each(function () {
        grandTotal3 += +$(this).val();
    });
    $("#subtotal2").text(grandTotal3.toFixed(2));

}

function calculate() {
    var grandTotal = 0;
    $("table#tablePARTA").find('input[name^="valuehidden"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));

     var grandTotal2 = 0;
    $("table#tablePARTB").find('input[name^="coghidden"]').each(function () {
        grandTotal2 += +$(this).val();
    });
    $("#subtotal").text(grandTotal2.toFixed(2));

     var grandTotal3 = 0;
    $("table#tablePARTB").find('input[name^="timehidden"]').each(function () {
        grandTotal3 += +$(this).val();
    });
    $("#subtotal2").text(grandTotal3.toFixed(2));


    var carcurrenttotalex = document.getElementById('inputdefault_carcurrent');
    carcurrenttotalexCalc = parseFloat(grandTotal);
    carcurrenttotalex.value = "$" + carcurrenttotalexCalc.toFixed(2);

    var carinvoicevalue = document.getElementById('inputdefault_carInvoicevalue');
    carinvoicevalueCalc = carcurrenttotalexCalc;
    carinvoicevalue.value = "$" + carinvoicevalueCalc.toFixed(2);

    var hours = document.getElementById('inputdefault_hours');
    var hoursCalc = parseFloat(grandTotal3);
    hours.value = hoursCalc.toFixed(2);

    var materialcost = document.getElementById('materialcost');
    var materialcostCalc = parseFloat(grandTotal2);
    materialcost.value = "$" + materialcostCalc.toFixed(2);

    var discount = document.getElementById('inputdefault_discountCAR').value;
    var discountCalc = parseFloat(discount) * 0.01;
    var discountvalue = document.getElementById('inputdefault_discountvalue');
    var discountvalueCalc = discountCalc * carinvoicevalueCalc;
    discountvalue.value = "$" + discountvalueCalc.toFixed(2); 

    var subtotalgst = document.getElementById('inputdefault_subtotalCAR');
    var subtotalgstCalc = parseFloat(carinvoicevalueCalc) - parseFloat(discountvalueCalc);  
    subtotalgst.value = "$" + subtotalgstCalc.toFixed(2);

    var cargst = document.getElementById('inputdefault_CARGST');
    var cargstCalc = subtotalgstCalc * .10;
    cargst.value = "$" + cargstCalc.toFixed(2);

    var cartotal = document.getElementById('inputdefault_cartotal');
    var cartotalCalc = parseFloat(subtotalgstCalc) + parseFloat(cargstCalc);
    cartotal.value = "$" + cartotalCalc.toFixed(2);



}

</script>

<!-- Computation based -->




<script>
$(document).ready(function() {
    $('#addselectedrows').click(function() {
       $('#tablePARTA > tbody:last').append('<tr><td></td><td><input type="checkbox" name="bookcheck_add_record[]" class="bcheck"/></td><td><input type="checkbox" name="letterscheck_add_record[]" value="1" class="lcheck"/></td><td><input type="text" name="code_add_record[]"  id="parta_code" class="parta_location" value=""></td><td><input type="text" name="location_add_record[]"  id="parta_location" class="parta_location" value=""></td><td><input type="text" name="equipment_add_record[]"  id="parta_equipment" class="parta_equipment" value=""></td><td><input type="text" name="fault_add_record[]"  id="partA_fault" class="partA_fault" value=""></td><td><input type="text" name="rectification_add_record[]"  id="partA_rectification" class="partA_rectification" value=""></td><td><input type="text" name="contactdetails_add_record[]"  id="partA_contactdetails" class="partA_contactdetails" value=""></td> <td><input type="text" name="status_add_record[]"  id="partA_statusInformation_test" class="partA_statusInformation_test" value=""></td><td><select id="partA_statusInformation" name="statusyesno_add_record[]" class="partA_status" ><option value=""></option><option value="Y">Y</option><option value="N">N</option></select></td><td><input type="text" name="value_add_record[]" id="partA_value" class="partA_value" value=""></td><td><input type="hidden" name="valuehidden" /></td><td><input type="checkbox" class="select_update_delete_CAR_portal" /></td></tr>');


       $('#tablePARTB > tbody:last').append('<tr><td></td><td><input type="text" id="partb_barcode" value=""/></td><td><input type="text" id="partb_phoenixproductcode" name="barcode" value=""/></td><td><input type="text" id="partb_CPWMnew" name="cpwmnew" value=""/></td><td><input type="text" id="PARTB_CPWM"  class="PARTB_CPWM" name="cpwm" value=""/></td><td><input type="text" id="PARTB_CPNM" class="PARTB_CPNM" name="cpnm" value=""/></td><td><input type="text" id="PARTB_Oncost" class="PARTB_Oncost" name="oncost" value=""/></td><td><input type="text" id="PARTB_COG" class="PARTB_COG" name="cog" value=""/></td><td><input type="text" name="coghidden" /></td><td><input type="text" name="costtotal" class="PARTB_Costtotal"  id="PARTB_Costtotal" value=""/></td><td><input type="text" id="PARTB_Time" class="PARTB_Time" name="time" oninput="calculate()" value=""/></td><td><input type="hidden" name="timehidden" /></td><td><input type="checkbox" class="select_update_delete_CAR_portal2" /></td><td><input type="hidden" id="recordID_partB" value=""/></td></tr>');

    });
});

</script>

<script>


$(document).ready(function() {
    var the_terms = $(".select_update_delete_CAR_portal");

    the_terms.click(function() {
        if ($(this).is(":checked")) {
            $("#deleteselectedrecords").removeAttr("disabled");
        } else {
            $("#deleteselectedrecords").attr("disabled", "disabled");
        }
    });
}); 


$(document).ready(function() {
    var the_terms = $(".select_update_delete_CAR_portal2");

    the_terms.click(function() {
        if ($(this).is(":checked")) {
            $("#deleteselectedrecords").removeAttr("disabled");
        } else {
            $("#deleteselectedrecords").attr("disabled", "disabled");
        }
    });
}); 
</script>



<?php 


$update_delete_ID_record_CAR = (isset($_POST['update_delete_ID_record_CAR'])) ? $_POST['update_delete_ID_record_CAR'] : "";


$parta_code = (isset($_POST['parta_code_CAR'])) ? $_POST['parta_code_CAR'] : "";
$parta_location = (isset($_POST['parta_location_CAR'])) ? $_POST['parta_location_CAR'] : "";
$parta_equipment = (isset($_POST['parta_equipment_CAR'])) ? $_POST['parta_equipment_CAR'] : "";
$partA_fault = (isset($_POST['parta_fault_CAR'])) ? $_POST['parta_fault_CAR'] : "";
$partA_rectification = (isset($_POST['parta_rectification_CAR'])) ? $_POST['parta_rectification_CAR'] : "";
$partA_contactdetails= (isset($_POST['parta_contactdetails_CAR'])) ? $_POST['parta_contactdetails_CAR'] : "";
$partA_statusInformation_test = (isset($_POST['parta_statusinformation_test_CAR'])) ? $_POST['parta_statusinformation_test_CAR'] : "";
$partA_statusInformation = (isset($_POST['parta_statusinformation_CAR'])) ? $_POST['parta_statusinformation_CAR'] : "";
$partA_value = (isset($_POST['parta_value_CAR'])) ? $_POST['parta_value_CAR'] : "";



/* Add information PORTAL */
$code_add_record = (isset($_POST['code_add_record'])) ? $_POST['code_add_record'] : "";

$location_add_record = (isset($_POST['location_add_record'])) ? $_POST['location_add_record'] : "";

$equipment_add_record = (isset($_POST['equipment_add_record'])) ? $_POST['equipment_add_record'] : "";

$fault_add_record = (isset($_POST['fault_add_record'])) ? $_POST['fault_add_record'] : "";

$rectification_add_record = (isset($_POST['rectification_add_record'])) ? $_POST['rectification_add_record'] : "";

$contactdetails_add_record = (isset($_POST['contactdetails_add_record'])) ? $_POST['contactdetails_add_record'] : "";

$status_add_record = (isset($_POST['status_add_record'])) ? $_POST['status_add_record'] : "";

$statusyesno_add_record = (isset($_POST['statusyesno_add_record'])) ? $_POST['statusyesno_add_record'] : "";

$value_add_record = (isset($_POST['value_add_record'])) ? $_POST['value_add_record'] : "";



if (isset($_POST['delete_portal_CAR'])){


$counts_delete_CARportalone = 0 ;

      foreach($update_delete_ID_record_CAR as $value_deleterecords_portalone_CAR){
        
          $value_selected_delete_portalone_CAR = $update_delete_ID_record_CAR;

          $record_delete_portalone_CAR = $fm->getRecordByID('carjobsheet_items_main', $value_selected_delete_portalone_CAR[$counts_delete_CARportalone]);

          $result_deletenotif_CAR_information = $record_delete_portalone_CAR->delete();

          if (FileMaker::isError($result_deletenotif_CAR_information)) {
                    echo '<script>alert("'. $result_deletenotif_CAR_information->getMessage().'");</script>';
          }

        $counts_delete_CARportalone++;
      }
    echo '<script> alert("Selected portal records are successfully deleted"); 

window.location.href = window.location.href;
    </script>';



}

?>




<div class="btnadrec">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="button">
              <input type="submit" id="btncss" name="addinfoworksheet_data" data-toggle="modal" data-target="#myModal_Add_successful" value="ADD" >
              <input type="submit" id="btncss" name="updateinfoworksheet" data-toggle="modal" data-target="#myModal_Update_successful" value="UPDATE" >
            </div>


   <?php 
$record_detected_message = $fm->getRecordByID("Carjobsheet", $record_IDinfo);

$related_records_jobsheet_message = $record_detected_message->getRelatedSet('Alert Message CAR Job Sheet');

if (!FileMaker::iserror ($related_records_jobsheet_message)) {
   foreach($related_records_jobsheet_message as $related_record_base){
    $alertinfo_checkbase = $related_record_base->getField('Alert Message CAR Job Sheet::Alert Message');

/* Check Condition */
if (isset($alertinfo_checkbase) && strlen($alertinfo_checkbase) > 0) {
  echo '

<input type="button" id="btncss" data-toggle="modal" data-target="#myModalNorm" value="Alert" style="color:yellow; font-weight:normal; background-color:red;"/>



  ';
}else{
  echo '<input type="button" id="btncss" data-toggle="modal" data-target="#myModalNorm" value="Alert" style="color:white; font-weight:normal; background-color:red;"/>';
}


/* Check Condition  */

   }
                      
}else{
   echo '<input type="button" id="btncss" data-toggle="modal" data-target="#myModalNorm" value="Alert" style="color:white; font-weight:normal; background-color:red;"/>';
}
?>



        </div>
    </div>
</div>

 <!-- Modal -->
      <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content message_normal_form">
                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">
                          Alert Information
                      </h4>
                  </div>


                  <?php

                  $record_showInformation = $fm->getRecordByID("Carjobsheet",  $record_IDinfo);
                  $related_messages = $record_showInformation->getRelatedSet('Alert Message CAR Job Sheet');

                  if (!FileMaker::iserror ($related_messages)) {
                    foreach($related_messages as $related_record)
                    {
                      $alertinfo = $related_record->getField('Alert Message CAR Job Sheet::Alert Message');
                      $sfg = $related_record->getRecordId();
                    }
                  }
                    $infomatics =  $alertinfo;
                    $id_detectedr =  $sfg;

                  ?>

                  <!-- Modal Body -->

                  <div class="modal-body">
                        <div class="form-group">
                          <textarea class="form-control noresize" name="infomessage" rows="5" id="alert_messageinformation"><?php echo $infomatics; ?></textarea>
                          <input type="text" name="record_message_ID" value="<?php echo $id_detectedr; ?>" hidden/>
                        </div>
                  </div>
      <input type="button" class="btn btn-danger"  id="btn_closeinformation_alert" data-dismiss="modal" value="Close"/>

              </div>
          </div>
      </div>


<!-- Create Letters -->
<?php 
if (isset($_POST['add_letters_operation'])){
  $info_job_createletter = (isset($_POST['info_job'])) ? $_POST['info_job'] : "";
$CARjobsheet_hash_createletter = (isset($_POST['CARjobsheet_hash'])) ? $_POST['CARjobsheet_hash'] : "";
$servicedate_carjobsheet_createletter = (isset($_POST['servicedate_new_carjobsheet'])) ? $_POST['servicedate_new_carjobsheet'] : "";
$servicedate_carjobsheet_revised_createletter = date('m/j/Y', strtotime($servicedate_carjobsheet_createletter));
$location_information = $_POST['location'];
$equipment_information = $_POST['equipment'];
$rectification_information = $_POST['rectification'];
$counts = 0 ;
                    foreach($_POST['letterscheck'] as $check) {

                        $value = $location_information;
                        $value2 = $equipment_information;
                        $value3 = $rectification_information;



                          $commandAdd_letters = $fm->newAddCommand("letters_report_information");
                          $commandAdd_letters->setField('job_no',   $info_job_createletter );
                          $commandAdd_letters->setField('car_no', $CARjobsheet_hash_createletter);
                          $commandAdd_letters->setField('service_date', $servicedate_carjobsheet_revised_createletter);
                          $commandAdd_letters->setField('location', $value[$counts]);
                          $commandAdd_letters->setField('equipment', $value2[$counts]);
                          $commandAdd_letters->setField('rectification',$value3[$counts]);

                          $result_letters = $commandAdd_letters->execute();

                          if (FileMaker::isError($result_letters)) {
                            echo '<script>alert("'.$result_letters->getMessage().'");</script>';
                            exit;
                          }else{

                          }

                        $counts++;
                      }//checkbox loop


                            echo'<script>alert("Letters created successfully");

                             var skip_detected_information = localStorage.getItem("track_skip_information_detected");
                             window.location.replace("http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet?skip=" + skip_detected_information + "&max=1" );

                            </script>';
}else if (isset($_POST['Apply_reschedulejob_information'])){

$parta_location = (isset($_POST['location'])) ? $_POST['location'] : "";
$parta_equipment = (isset($_POST['equipment'])) ? $_POST['equipment'] : "";
$partA_fault= (isset($_POST['fault'])) ? $_POST['fault'] : "";
$partA_rectification= (isset($_POST['rectification'])) ? $_POST['rectification'] : "";
$partA_contactdetails = (isset($_POST['contact_details'])) ? $_POST['contact_details'] : "";
$partA_statusInformation_test = (isset($_POST['status_information_test'])) ? $_POST['status_information_test'] : "";
$partA_value = (isset($_POST['value'])) ? $_POST['value'] : "";
$record_info_jobreschedule = (isset($_POST['record_information_a'])) ? $_POST['record_information_a'] : "";
$location_information =  (isset($_POST['status_b'])) ? $_POST['status_b'] : "";

$jobnumber_update_reschedule = (isset($_POST['information_job_latest'])) ? $_POST['information_job_latest'] : "";
$ID_reschedule = (isset($_POST['ID_reschedule'])) ? $_POST['ID_reschedule'] : "";

  $request_duplicate = $fm->newDuplicateCommand("Carjobsheet", $record_info_jobreschedule);
  $result_duplicate = $request_duplicate->execute();

     if (FileMaker::isError($result_duplicate)) {
       exit;
   }else{


  }


       $edit_informationt = $fm->newEditCommand('Carjobsheet', $ID_reschedule + 1);
       $edit_informationt->setField('Sheet Type',  "2");
       $edit_informationt->setField('Job Number',  $jobnumber_update_reschedule);
       $result_updateCAR = $edit_informationt->execute();


         if (FileMaker::isError( $result_updateCAR)) {
           echo '<script>alert("'.  $result_updateCAR->getMessage().'");</script>';
           exit;
         }else{

                          $counts_reschedulejob = 0 ;
         foreach($location_information as $value_information) {

       if (strpos($value_information, 'N') !== false){

         $value = $parta_location;
          $value2 = $parta_equipment;
          $value3 = $partA_fault;
          $value4 = $partA_rectification;
          $value5 = $partA_contactdetails;
          $value6 = $partA_statusInformation_test;
          $value7 = $partA_value ;

          $record_carworksheet_resched = $fm->getRecordByID("Carjobsheet",  $ID_reschedule + 1);
          $new_carrecord_testregister = $record_carworksheet_resched->newRelatedRecord('CAR Job Sheet Items');
          $new_carrecord_testregister->setField('CAR Job Sheet Items::location',    $value[$counts_reschedulejob] );
          $new_carrecord_testregister->setField('CAR Job Sheet Items::equipment', $value2[$counts_reschedulejob]);
          $new_carrecord_testregister->setField('CAR Job Sheet Items::fault', $value3[$counts_reschedulejob]);
          $new_carrecord_testregister->setField('CAR Job Sheet Items::rectification',  $value4[$counts_reschedulejob]);
          $new_carrecord_testregister->setField('CAR Job Sheet Items::contact_details',  $value5[$counts_reschedulejob]);
          $new_carrecord_testregister->setField('CAR Job Sheet Items::Status',  $value6[$counts_reschedulejob]);
          $new_carrecord_testregister->setField('CAR Job Sheet Items::value',  $value7[$counts_reschedulejob]);
          $counts_reschedulejob++;

         $result_testregistercarrecord = $new_carrecord_testregister->commit();


         if (FileMaker::isError( $result_testregistercarrecord)) {
           exit;
         }else{
         }
       }
     }

         }

      
   echo '<script> alert("Reschedule Job is completed"); </script>';


      echo '
        <script>
      var duplicate_information_b = parseInt(localStorage.getItem("total_record"));

 window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" + "?skip=" +  duplicate_information_b  + "&max=1";
       </script>';


}


?>


<?php 
$infojob_carinvoice = (isset($_POST['info_job'])) ? $_POST['info_job'] : "";
$servicedate_carjobsheet_carinvoice = (isset($_POST['servicedate_carjobsheet'])) ? $_POST['servicedate_carjobsheet'] : "";
$servicedate_carjobsheet_revised_carinvoice= date('m/j/Y', strtotime($servicedate_carjobsheet_carinvoice));
$clientinformation_carinvoice = (isset($_POST['clientname_carjobsheet'])) ? $_POST['clientname_carjobsheet'] : "";
$inputdefault_servicetype_carjobsheet_carinvoice = (isset($_POST['inputdefault_servicetype_carjobsheet'])) ? $_POST['inputdefault_servicetype_carjobsheet'] : "";
$CARjobsheet_sheet_carinvoice = (isset($_POST['CARjobsheet_hash'])) ? $_POST['CARjobsheet_hash'] : "";
$acceptedby_carjobsheet_carinvoice = (isset($_POST['acceptedby_carjobsheet'])) ? $_POST['acceptedby_carjobsheet'] : "";
$accepteddate_carjobsheet_copy_carinvoice = (isset($_POST['accepteddate_carjobsheet'])) ? $_POST['accepteddate_carjobsheet'] : "";
$acceptinfoc_carinvoice = date('m/j/Y', strtotime($accepteddate_carjobsheet_copy_carinvoice));
$strataplan_info_carinvoice= (isset($_POST['strataplan_carjobsheet'])) ? $_POST['strataplan_carjobsheet'] : "";
$street_carjobsheet_carinvoice= (isset($_POST['street_carjobsheet'])) ? $_POST['street_carjobsheet'] : "";
$city_carjobsheet_carinvoice= (isset($_POST['city_carjobsheet'])) ? $_POST['city_carjobsheet'] : "";
$siteID_carjobsheet_carinvoice= (isset($_POST['siteID_carjobsheet'])) ? $_POST['siteID_carjobsheet'] : "";


$code_invoice_carinvoice= (isset($_POST['code_invoice'])) ? $_POST['code_invoice'] : "";
$location_invoice_carinvoice= (isset($_POST['location_invoice'])) ? $_POST['location_invoice'] : "";
$description_invoice_carinvoice= (isset($_POST['description_invoice'])) ? $_POST['description_invoice'] : "";
$amount_invoice_carinvoice= (isset($_POST['amount_invoice'])) ? $_POST['amount_invoice'] : "";
$status_b= (isset($_POST['status_b'])) ? $_POST['status_b'] : "";

$status_information_test_yes = (isset($_POST['status_b'])) ? $_POST['status_b'] : "";

if (isset($_POST{'CAR_invoice_submit_information'})){

     $commandAdd_carinvoice = $fm->newAddCommand("carinvoices_layout");
     $commandAdd_carinvoice->setField('invoice_type', "2");
     $commandAdd_carinvoice->setField('Job #',$infojob_carinvoice);
     $commandAdd_carinvoice->setField('CAR #',$CARjobsheet_sheet_carinvoice);
     if ($servicedate_carjobsheet_revised_carinvoice == "01/1/1970"){
         
       }else{
          $commandAdd_carinvoice->setField('Service Date', $servicedate_carjobsheet_revised_carinvoice);
       }
    
     $commandAdd_carinvoice->setField('Service Type', $inputdefault_servicetype_carjobsheet_carinvoice);
     $commandAdd_carinvoice->setField('company', $clientinformation_carinvoice );
     $commandAdd_carinvoice->setField('Site ID', $siteID_carjobsheet_carinvoice);
     $commandAdd_carinvoice->setField('Strata Plan', $strataplan_info_carinvoice);
     $commandAdd_carinvoice->setField('Client Street', $street_carjobsheet_carinvoice);
     $commandAdd_carinvoice->setField('Client Suburb', $city_carjobsheet_carinvoice);
     $commandAdd_carinvoice->setField('Accepted By', $acceptedby_carjobsheet_carinvoice);
     if ($acceptinfoc_carinvoice == "01/1/1970"){
         
       }else{
         $commandAdd_carinvoice->setField('Accepted Date', $acceptinfoc_carinvoice);
       }
    


     $result_car_invoice= $commandAdd_carinvoice->execute();

      if (FileMaker::isError($result_car_invoice)) {
        echo '<script>alert("'.$result_car_invoice->getMessage().'");</script>';
        exit;

      }else{



  $counts_carjobitems = 0 ;

     foreach($status_information_test_yes as $check) {

         $value_carinvoice =  $location_invoice_carinvoice;
         $value2_carinvoice = $description_invoice_carinvoice;
         $value3_carinvoice = $amount_invoice_carinvoice;
         $value4_carinvoice = $code_invoice_carinvoice;
         $value5_carinvoice = $status_information_test_yes;

         if ($check == "Y"){
         $carinvoice_service = $fm->getRecordByID("carinvoices_layout",  $carinvoice_ID_highest);
         $new_carinvoice_info = $carinvoice_service->newRelatedRecord('CAR Invoice Items');
         
    
         $new_carinvoice_info->setField('CAR Invoice Items::location', $value_carinvoice[$counts_carjobitems]);

         $new_carinvoice_info->setField('CAR Invoice Items::description', $value2_carinvoice[$counts_carjobitems]);

         $new_carinvoice_info->setField('CAR Invoice Items::amount', $value3_carinvoice[$counts_carjobitems]);


         $counts_carjobitems++;
         $result_jobinvoice = $new_carinvoice_info->commit();

          if (FileMaker::isError($result_jobinvoice)) {
                 echo '<script>alert("'.   $result_jobinvoice->getMessage().'");</script>';
                  exit;}
          else{
             
           }
           
         }else{

         }
     }

        echo '<script> alert("Successfully Created CAR Invoice"); </script>';
  } 
}
?>



 <div id="container-floating">

<span>
 <div class="nd5 nds" data-toggle="tooltip" data-placement="left" data-original-title="Omit"><img class="omit_information" src="<?php echo base_url('/img/forbidden.png'); ?>" style="margin-left:0.3em;"></div>
</span>


<span>
  <div class="nd5 nds" data-toggle="tooltip" data-placement="left" data-original-title="Omit"><img class="omit_information" src="<?php echo base_url('/img/forbidden.png'); ?>" style="margin-left:0.3em;"></div>
</span>

<span data-toggle="modal" data-target="#myModal_duplicate">
  <div class="nd4 nds" data-toggle="tooltip" data-placement="left" data-original-title="Duplicate"><img class="reminder" src="<?php echo base_url('/img/002-duplicate.png'); ?>"></div>
</span>

 <span data-toggle="modal" data-target="#myModal_Delete">
  <div class="nd3 nds" data-toggle="tooltip" data-placement="left" data-original-title="Minus"><img class="reminder" src="<?php echo base_url('/img/x-button.png'); ?>"></div>
</span>

<span data-toggle="modal" data-target="#myModal_Add" class="launchconfirmadd_carjobworksheet">
  <div class="nd1 nds" data-toggle="tooltip" data-placement="left" data-original-title="Add"><img class="reminder" src="<?php echo base_url('/img/004-plus.png'); ?>"></div>
</span>

  <div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Create">
    <p class="plus">+</p>
    <img class="edit" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
  </div>

</div>


<!-- Modal Add -->

  <div class="modal fade" id="myModal_Add" role="dialog">
    <div class="modal-dialog" id="confirm_add_worksheet_carjob">

      <!-- Modal content-->
      <div class="modal-content add_move">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message (Add a blank record)</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent">Do you want to create a new record? This will clear all the fields, just click refresh on browser to show the current data.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_2" data-value="0">Cancel</button>
          <button type="button" class="btn btn-primary" id="addrecord_click" data-dismiss="modal" data-value="1">OK</button>
        </div>
      </div>

    </div>
  </div>


<!-- Modal Add Record Successful -->
<div class="modal fade" id="myModal_Add_successful" role="dialog">
    <div class="modal-dialog" id="confirm_add_successful">

      <!-- Modal content-->
      <div class="modal-content add_move_successful">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message: New record is successfully added</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent">A new record is successfully added.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="addrecord_successful_click" data-dismiss="modal" data-value="1">OK</button>
        </div>
      </div>

    </div>
  </div>

<!-- Modal Add Record Successful -->


<!-- Modal Update Record Successful -->
  <div class="modal fade mymodal_update_successful" id="myModal_Update_successful" role="dialog">
    <div class="modal-dialog" id="confirm_update_successful">

      <!-- Modal content-->
      <div class="modal-content add_move_successful">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message: Update confirmation</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent">The record is updated successfully.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="updaterecord_successful_click" data-dismiss="modal" data-value="1">OK</button>
        </div>
      </div>

    </div>
  </div>
<!-- Modal Update Record Successful -->

 <!-- Modal Duplicate Record -->
            <div class="modal fade" id="myModal_duplicate" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content duplicate_move">
                  <div class="modal-header">
                  <h4 class="modal-title">Message (Duplicate confirmation)</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <p id="modal_messagecontent1">Do you want to duplicate the record?</p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_1">No</button>
                    <input type="submit" class="btn btn-primary" name="infoduplicate_button" id="current_OK" value="Yes"/>
                  </div>

                </div>

              </div>

            </div>




  <!-- Modal Delete -->
       <!-- Modal Delete Record -->
  <div class="modal fade" id="myModal_Delete" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content delete_move">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message (Delete confirmation)</h4>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent">Do you want to delete the current record?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_2">Cancel</button>
          <button type="button" class="btn btn-danger" id="current_click" data-dismiss="modal">OK</button>
        </div>
      </div>

    </div>
  </div>
          <!-- Modal Delete Record -->

          <!-- Modal Delete Record Current Secondary -->
     <div class="modal" id="myModal_secondary_response_current" role="dialog">
     <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content deletecurrent_move">
        <div class="modal-header">
          <h4 class="modal-title">Message (Delete current records)</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="modal_messagecontent">Are you sure to delete the current records?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_2">No</button>
          <input type="submit" class="btn btn-danger" name="info_delete_command"  id="current_click"  value="Yes"/>
        </div>
      </div>

    </div>
  </div>


<!-- Modal Delete -->

<?php
$record_info_b = (isset($_POST['record_information_a'])) ? $_POST['record_information_a'] : "";
$jobsheettype_b = (isset($_POST['jobsheettype'])) ? $_POST['jobsheettype'] : "";
$sheet_type_b = (isset($_POST['sheetype'])) ? $_POST['sheetype'] : "";
$information_job_number = (isset($_POST['information_job_latest'])) ? $_POST['information_job_latest'] : "";
$id_CARworksheet_ID = (isset($_POST['id_CARworksheet_ID'])) ? $_POST['id_CARworksheet_ID'] : "";
$track_skipinformation = (isset($_POST['track_skipinformation'])) ? $_POST['track_skipinformation'] : "";

/* //////////////////////////////////////////////////////////// */


$servicetime_carjobsheet= (isset($_POST['servicetime_carjobsheet'])) ? $_POST['servicetime_carjobsheet'] : "";
$servicedate_carjobsheet = (isset($_POST['servicedate_carjobsheet'])) ? $_POST['servicedate_carjobsheet'] : "";
$servicedate_carjobsheet_revised = date('m/j/Y', strtotime($servicedate_carjobsheet));
$clientinformation = (isset($_POST['clientname_carjobsheet'])) ? $_POST['clientname_carjobsheet'] : "";


$name_technician_carjobsheet = (isset($_POST['name_technician_carjobsheet'])) ? $_POST['name_technician_carjobsheet'] : "";
$inputdefault_servicetype_carjobsheet = (isset($_POST['inputdefault_servicetype_carjobsheet'])) ? $_POST['inputdefault_servicetype_carjobsheet'] : "";
$CARjobsheet_sheet_hash = (isset($_POST['CARjobsheet_hash'])) ? $_POST['CARjobsheet_hash'] : "";
$workorderno_carjobsheet= (isset($_POST['workorderno_carjobsheet'])) ? $_POST['workorderno_carjobsheet'] : "";
$invoiceno_carjobsheet = (isset($_POST['invoiceno_carjobsheet'])) ? $_POST['invoiceno_carjobsheet'] : "";
$completedYN_carjobsheet= (isset($_POST['completedYN_carjobsheet'])) ? $_POST['completedYN_carjobsheet'] : "";
$name_managerapproval_carjobsheet = (isset($_POST['name_managerapproval_carjobsheet'])) ? $_POST['name_managerapproval_carjobsheet'] : "";


$name_lettersent_carjobsheet = (isset($_POST['name_lettersent_carjobsheet'])) ? $_POST['name_lettersent_carjobsheet'] : "";

$name_letter_sent_date_carjobsheet= (isset($_POST['name_letter_sent_date_carjobsheet'])) ? $_POST['name_letter_sent_date_carjobsheet'] : "";
$name_letter_sent_date_carjobsheet_revised = date('m/j/Y', strtotime($name_letter_sent_date_carjobsheet));




$textsent_info= (isset($_POST['textsent_carjobsheet'])) ? $_POST['textsent_carjobsheet'] : "";
$textdate_carjobsheet = (isset($_POST['textdate_carjobsheet'])) ? $_POST['textdate_carjobsheet'] : "";
$textdate_carjobsheet_revised= date('m/j/Y', strtotime($textdate_carjobsheet));

$acceptedby_carjobsheet = (isset($_POST['acceptedby_carjobsheet'])) ? $_POST['acceptedby_carjobsheet'] : "";
$accepteddate_carjobsheet = (isset($_POST['accepteddate_carjobsheet'])) ? $_POST['accepteddate_carjobsheet'] : "";
$acceptdate_carjobsheet_revised = date('m/j/Y', strtotime($accepteddate_carjobsheet));


$strataplan_info= (isset($_POST['strataplan_carjobsheet'])) ? $_POST['strataplan_carjobsheet'] : "";
$street_carjobsheet= (isset($_POST['street_carjobsheet'])) ? $_POST['street_carjobsheet'] : "";
$city_carjobsheet= (isset($_POST['city_carjobsheet'])) ? $_POST['city_carjobsheet'] : "";

$postalcode_carjobsheet= (isset($_POST['postal_code_carjobsheet'])) ? $_POST['postal_code_carjobsheet'] : "";
$keyregisterID_carjobsheet= (isset($_POST['keyregisterID_CAR'])) ? $_POST['keyregisterID_CAR'] : "";
$factorednon_carjobsheet= (isset($_POST['factorednon_CAR'])) ? $_POST['factorednon_CAR'] : "";

$senttocontractor_CAR_info = (isset($_POST['senttocontractor_CAR'])) ? $_POST['senttocontractor_CAR'] : "";
$senttocontractor_date_info_revised = date('m/j/Y', strtotime($senttocontractor_CAR_info));

$contractor_carjobsheet= (isset($_POST['contractor_CAR'])) ? $_POST['contractor_CAR'] : "";

$additionalnotes_carjobsheet= (isset($_POST['additionalnotes_CAR_copy'])) ? $_POST['additionalnotes_CAR_copy'] : "";
$tenantdetails_carjobsheet= (isset($_POST['tenantdetails_CAR_copy'])) ? $_POST['tenantdetails_CAR_copy'] : "";
$comment_carjobsheet= (isset($_POST['comment_CAR_copy'])) ? $_POST['comment_CAR_copy'] : "";

/* //////////////////////////////////////////////////////// */

if (isset($_POST['addinfoworksheet_data'])) {
  $commandAdd_worksheet = $fm->newAddCommand("Carjobsheet");
  $commandAdd_worksheet->setField('Job Number',  $information_job_number);
  $commandAdd_worksheet->setField('Sheet Type', "2");

if ($servicedate_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandAdd_worksheet->setField('Service Date', $servicedate_carjobsheet_revised);
       }

  
  $commandAdd_worksheet->setField('Service Time', $servicetime_carjobsheet);
  $commandAdd_worksheet->setField('Company', $clientinformation);

   $commandAdd_worksheet->setField('Technician', $name_technician_carjobsheet);
   $commandAdd_worksheet->setField('Service Type',  $inputdefault_servicetype_carjobsheet);
   $commandAdd_worksheet->setField('Work Order', $workorderno_carjobsheet);
   $commandAdd_worksheet->setField('Invoice #',  $invoiceno_carjobsheet);
   $commandAdd_worksheet->setField('Completed Y/N',  $completedYN_carjobsheet);
   $commandAdd_worksheet->setField('Manager Approval', $name_managerapproval_carjobsheet);
   $commandAdd_worksheet->setField('CAR#', $CARjobsheet_sheet_hash);


    $commandAdd_worksheet->setField('letters sent', $name_lettersent_carjobsheet );

    if ($name_letter_sent_date_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
   $commandAdd_worksheet->setField('Letters sent date', $name_letter_sent_date_carjobsheet_revised);
       }

    

    $commandAdd_worksheet->setField('Text Sent', $textsent_info);

if ($textdate_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandAdd_worksheet->setField('Text Date', $textdate_carjobsheet_revised);
       }

    
    
    $commandAdd_worksheet->setField('Accepted By', $acceptedby_carjobsheet);

    if ($acceptdate_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandAdd_worksheet->setField('Accepted Date', $acceptdate_carjobsheet_revised);
       }
    

    $commandAdd_worksheet->setField('Strata Plan', $strataplan_info);
    $commandAdd_worksheet->setField('Street 1', $street_carjobsheet);
    $commandAdd_worksheet->setField('City 1', $city_carjobsheet);
    $commandAdd_worksheet->setField('Postal Code', $postalcode_carjobsheet);
    $commandAdd_worksheet->setField('Key_Register_ID_CJS',  $keyregisterID_carjobsheet);
    $commandAdd_worksheet->setField('Factored_Non_Factored',  $factorednon_carjobsheet);


if ($senttocontractor_date_info_revised == "01/1/1970"){
         
       }else{
       
   $commandAdd_worksheet->setField('Sent to Contractor',  $senttocontractor_date_info_revised);
       }
    
    $commandAdd_worksheet->setField('Contractor', $contractor_carjobsheet);

    $commandAdd_worksheet->setField('Notes', $additionalnotes_carjobsheet);
    $commandAdd_worksheet->setField('tenant details',$tenantdetails_carjobsheet);
    $commandAdd_worksheet->setField('comments', $comment_carjobsheet);


 $result_worksheet = $commandAdd_worksheet->execute();

  if (FileMaker::isError($result_worksheet)) {
    echo '<script>alert("'.$result_worksheet->getMessage().'");</script>';
    exit;
  }else{
    echo '<script>

        jQuery(document).ready(function(e) {
        jQuery("#myModal_Add_successful").trigger("click");
        });
        </script>';
    echo'<script>
       var someVarName_preview_add = parseInt(localStorage.getItem("total_record"));
     

     window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" + "?skip=" +  someVarName_preview_add + "&max=1";

     </script>';

  }



}

if (isset($_POST['updateinfoworksheet'])){

    $commandUpdate_worksheet = $fm->newEditCommand("Carjobsheet", $record_info_b);
  $commandUpdate_worksheet->setField('Sheet Type', "2");

if ($servicedate_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandUpdate_worksheet->setField('Service Date', $servicedate_carjobsheet_revised);
       }

  
  $commandUpdate_worksheet->setField('Service Time', $servicetime_carjobsheet);
  $commandUpdate_worksheet->setField('Company', $clientinformation);

   $commandUpdate_worksheet->setField('Technician', $name_technician_carjobsheet);
   $commandUpdate_worksheet->setField('Service Type',  $inputdefault_servicetype_carjobsheet);
   $commandUpdate_worksheet->setField('Work Order', $workorderno_carjobsheet);
   $commandUpdate_worksheet->setField('Invoice #',  $invoiceno_carjobsheet);
   $commandUpdate_worksheet->setField('Completed Y/N',  $completedYN_carjobsheet);
   $commandUpdate_worksheet->setField('Manager Approval', $name_managerapproval_carjobsheet);
   $commandUpdate_worksheet->setField('CAR#', $CARjobsheet_sheet_hash);


    $commandUpdate_worksheet->setField('letters sent', $name_lettersent_carjobsheet );

    if ($name_letter_sent_date_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandUpdate_worksheet->setField('Letters sent date', $name_letter_sent_date_carjobsheet_revised);
       }
    

    $commandUpdate_worksheet->setField('Text Sent', $textsent_info);
    $commandUpdate_worksheet->setField('Text Date', $textdate_carjobsheet_revised);
    $commandUpdate_worksheet->setField('Accepted By', $acceptedby_carjobsheet);

if ($acceptdate_carjobsheet_revised == "01/1/1970"){
         
       }else{
       
    $commandUpdate_worksheet->setField('Accepted Date', $acceptdate_carjobsheet_revised);
       }


    

    $commandUpdate_worksheet->setField('Strata Plan', $strataplan_info);
    $commandUpdate_worksheet->setField('Street 1', $street_carjobsheet);
    $commandUpdate_worksheet->setField('City 1', $city_carjobsheet);
    $commandUpdate_worksheet->setField('Postal Code', $postalcode_carjobsheet);
    $commandUpdate_worksheet->setField('Key_Register_ID_CJS',  $keyregisterID_carjobsheet);
    $commandUpdate_worksheet->setField('Factored_Non_Factored',  $factorednon_carjobsheet);

if ($senttocontractor_date_info_revised == "01/1/1970"){
         
       }else{
       
    $commandUpdate_worksheet->setField('Sent to Contractor',  $senttocontractor_date_info_revised);
       }


    
    $commandUpdate_worksheet->setField('Contractor', $contractor_carjobsheet);

    $commandUpdate_worksheet->setField('Notes', $additionalnotes_carjobsheet);
    $commandUpdate_worksheet->setField('tenant details',$tenantdetails_carjobsheet);
    $commandUpdate_worksheet->setField('comments', $comment_carjobsheet);



/* Update Information Portal CAR (Partial Only) */


$count_information_CAR = 0;
        foreach($update_delete_ID_record_CAR as $check_update_selectID) {

            $value_update_mechanism_CAR_portalone_ID = $update_delete_ID_record_CAR;
            $value2_update_mechanism_CAR_portalone = $parta_code;
            $value3_update_mechanism_CAR_portalone = $parta_location;
            $value4_update_mechanism_CAR_portalone = $parta_equipment;
            $value5_update_mechanism_CAR_portalone = $partA_fault;
            $value6_update_mechanism_CAR_portalone = $partA_rectification;
            $value7_update_mechanism_CAR_portalone = $partA_contactdetails;
            $value8_update_mechanism_CAR_portalone = $partA_statusInformation_test;
            $value9_update_mechanism_CAR_portalone = $partA_statusInformation;
            $value10_update_mechanism_CAR_portalone = $partA_value;

       $edit_record_worksheetinformation_CARitems = $fm->newEditCommand('carjobsheet_items_main',  $value_update_mechanism_CAR_portalone_ID[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('code', $value2_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('location', $value3_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('equipment', $value4_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('fault', $value5_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('rectification', $value6_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('contact_details', $value7_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('Status', $value8_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('complete_yn', $value9_update_mechanism_CAR_portalone[$count_information_CAR]);

       $edit_record_worksheetinformation_CARitems->setField('value', $value10_update_mechanism_CAR_portalone[$count_information_CAR]);

        $result_CARitems = $edit_record_worksheetinformation_CARitems->execute();

                $count_information_CAR++;

                 if (FileMaker::isError($result_CARitems)) {
                    echo '<script>alert("'. $result_CARitems->getMessage().'");</script>';
                    exit;
                 }else{
                  echo '<script> alert("Test_update"); </script>';
                 }


        }  
   


/* Add Information Portal CAR (Partial Only) */
 $counts_add_portalone_record_CAR = 0 ;
         foreach($code_add_record as $value_information_ADD_CAR) {

          $value_information_portalone_ADD_CAR =  $code_add_record;
          $value2_information_portalone_ADD_CAR = $location_add_record;
          $value3_information_portalone_ADD_CAR = $equipment_add_record;
          $value4_information_portalone_ADD_CAR = $fault_add_record;
          $value5_information_portalone_ADD_CAR = $rectification_add_record;
          $value6_information_portalone_ADD_CAR = $contactdetails_add_record;
          $value7_information_portalone_ADD_CAR = $status_add_record;
          $value8_information_portalone_ADD_CAR = $statusyesno_add_record;
          $value9_information_portalone_ADD_CAR = $value_add_record; 
   

           $record_CARworksheet_information = $fm->getRecordByID("Carjobsheet", $record_IDinfo);
           $new_CARworksheet_information = $record_CARworksheet_information->newRelatedRecord('CAR Job Sheet Items');

           $new_CARworksheet_information->setField('CAR Job Sheet Items::job_no',$job_number_info);

            $new_CARworksheet_information->setField('CAR Job Sheet Items::sheet_type', "2");


           $new_CARworksheet_information->setField('CAR Job Sheet Items::code',$value_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::location',$value2_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::equipment',$value3_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::fault',$value4_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::rectification',$value5_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::contact_details',$value6_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::Status',$value7_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::complete_yn',$value8_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

           $new_CARworksheet_information->setField('CAR Job Sheet Items::value',$value9_information_portalone_ADD_CAR[$counts_add_portalone_record_CAR]);

        
           $counts_add_portalone_record_CAR++;

         $result_CARworksheet_portalone =  $new_CARworksheet_information->commit();


          if (FileMaker::isError( $result_CARworksheet_portalone )) {
           exit;
         }else{ 

            echo '<script>alert("test_added"); </script>';
         }


         }
          /* Portal Add Records (Date 1) */



 $result_worksheet = $commandUpdate_worksheet->execute();

  if (FileMaker::isError($result_worksheet)) {
    echo '<script>alert("'.$result_worksheet->getMessage().'");</script>';
    exit;
  }else{
     echo '<script>

        jQuery(document).ready(function(e) {
        jQuery("#myModal_Update_successful").trigger("click");
        });
        </script>';
    echo'<script>
       var someVarName_preview_update = parseInt(localStorage.getItem("track_skip_information_detected"));
     

     window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" + "?skip=" +  someVarName_preview_update + "&max=1";

     </script>';

  }

}

   if (isset($_POST['infoduplicate_button'])) {

         $request_duplicate = $fm->newDuplicateCommand("Carjobsheet",$record_info_b);
         $result_duplicate = $request_duplicate->execute();

           if (FileMaker::isError($result_duplicate)) {
                  exit;
               }else{
                    echo '
                    <script>
                      var someVarName_preview_duplicate = parseInt(localStorage.getItem("total_record"));

                       window.location.href =
                       "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" + "?skip=" +  someVarName_preview_duplicate  + "&max=1";
                     </script>';


                     $edit_informationt = $fm->newEditCommand('Carjobsheet', $id_CARworksheet_ID);
                     $edit_informationt->setField('Job Number', $information_job_number);
                     $result_worksheet_update = $edit_informationt->execute();
                    }
        }


  if (isset($_POST['info_delete_command'])) {

           $recorddelete = $fm->getRecordByID("Carjobsheet", $record_info_b);
           $result_deletenotif = $recorddelete->delete();

          if (FileMaker::isError($result_deletenotif))
              {
              echo "<p>Error: " . $result_deletenotif->getMessage() . "</p>";
              exit;
              } else{

                $commandAdd_worksheet_technicalprocess = $fm->newAddCommand("Carjobsheet");
                $commandAdd_worksheet_technicalprocess->setField('Sheet Type', "2");
                $result_worksheet_technicalprocess = $commandAdd_worksheet_technicalprocess->execute();

                if (FileMaker::isError($result_worksheet_technicalprocess)) {
                  echo '<script>alert("'.$result_worksheet_technicalprocess->getMessage().'");</script>';
                   exit;
                }



                if ($track_skipinformation  == 0){

              echo '<script>
                    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/servicejob_sheet" + "?skip=" +  "0" + "&max=1";
                    </script>';
                }else{

              echo '<script>
                    var someVarName_preview_new = parseInt(localStorage.getItem("track_skip_information_detected")) - 1;
                    window.location.href = "http://armontsys.ddns.net/test site/phoenix_codeigniter/index.php/Worksheet/carjob_sheet" + "?skip=" +  someVarName_preview_new  + "&max=1";
                    </script>';
                }


          }

      }



?>


<footer></footer>
<!-- End Footer -->
<div class="overlay">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php echo base_url(); ?>js/phoenix_worksheet2.js"></script>
    <script src="<?php echo base_url(); ?>js/functions_phoenix.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</div>
</form>
</body>
  </html>