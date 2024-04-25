<?php

include "../_config.php";
echo '<table class="table table-hover table-bordered caption-top mt-4">
                    <caption>Your Transaction</caption>
               <thead class="table-dark text-center">
                    <tr>
                         <th scope="col" class="col-1">No.</th>
                         <th scope="col" class="col-2">Date</th>
                         <th scope="col" class="col-1">Day</th>
                         <th scope="col" class="col-4">Particular</th>
                         <th scope="col" class="col-1">Income</th>
                         <th scope="col" class="col-1">Expense</th>
                         <th scope="col" class="col-2">Action</th>
                    </tr>
               </thead>
               <tbody>';
$query = "SELECT * FROM transaction";
$result = $conn->query($query);
if ($result->num_rows > 0) {
     $total_income = 0;
     $total_exp = 0;
     while ($row = $result->fetch_assoc()) {
          $income = "-";
          $exp = "-";
          if ($row['state'] == "income") {
               $income = $row['t_amount'];
               $total_income += $income;
          } else {
               $exp = $row['t_amount'];
               $total_exp += $exp;
          }

          echo '<tr>
                                   <td>' . $row['t_id'] . '</td>
                                   <td>' . $row['t_date'] . '</td>
                                   <td>' . $row['day'] . '</td>
                                   <td>' . $row['t_desc'] . '</td>
                                   <td>' . $income . '</td>
                                   <td>' . $exp . '</td>
                                   <td class="text-center"> <button class="btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn-sm btn-danger"><i class="bi bi-calendar-x"></i></button>
                                   </td>
                                </tr>
                              ';
     }
}
echo '
               </tbody>
          </table>';
