<?php
$a = 0;
echo '<table class = "table">
<thead>
<tr>
  <th scope="col">Edit CV</th>
  <th scope="col">View CV</th>
  <th scope="col">Name</th>
  <th scope="col">Status</th>
</tr>
</thead>
</table>';
foreach ($IDs as $value) {
  echo '<table class = "table">

<tbody>
  <tr>
    <th width = "26.4%" scope="row"><a href="cv/edit/' . $IDs[$a] . '"><u>edit</u></a></th>
    <th width = "27%" scope="row"><a href="cv/view/' . $IDs[$a] . '"><u>View</u></td>
    <th width = "24%"scope="row"><a>' . $names[$a] . '</a></td>
    <th>Finish</td>
  </tr>
</tbody>
</table>';
  $a = $a + 1;
}
// echo '<div>'.$names[0].'</div>';
// echo '<div>'.$IDs[0].'</div>';
// echo '<a href="cv/view/'.$IDs[0].'"></a>';
echo '<a class="btn btn-primary m-1" href="cv/create">Create your CV</a>';
