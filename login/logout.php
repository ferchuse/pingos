<?php 
session_start();
session_destroy();
//unset(session_id());
header("location:main_login.php");
?>
<!--
<SCRIPT LANGUAGE="javascript">
location.href = "index.php";
</SCRIPT>

-->