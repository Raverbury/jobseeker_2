<?php
  if (isset($_SESSION['showMessage'])) {
    if ($_SESSION['showMessage']) {
      echo '<div class="container mt-3" id="messageBox"><div class="alert alert-' . $_SESSION['messageType'] . '">' . $_SESSION['message'] . '</div></div>';
      $_SESSION['showMessage'] = false;
    }
  }
