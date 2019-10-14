<select name="month">
<?php
foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthNumber => $month) {
    echo "<option value='$monthNumber'>{$month}</option>";
}
?>
</select>