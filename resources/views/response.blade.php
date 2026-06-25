<?php
$status = $paymentData['order_status'];

if ($status == 'Success') {

    // Payment Success

} elseif ($status == 'Aborted') {

    // User Cancelled

} elseif ($status == 'Failure') {

    // Payment Failed
}