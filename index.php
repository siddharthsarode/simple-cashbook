<?php

include "_config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="error-box">
        <strong id="show-error">Something Went Wrong!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="success-box">
        <strong id="show-msg"></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- modal box -->
    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h3 class="text-center mb-3">Add Transaction</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="w-100" id="transaction-form">
            <div class="row">
                <div class="mb-2 col-sm-2">
                    <input type="date" name="dt" id="dt" class="form-control" required placeholder="yyyy/mm/dd">
                </div>
                <div class="mb-2 col-sm-2">
                    <input type="number" name="amt" id="amt" class="form-control" required placeholder="Enter Amount ">
                </div>
                <!-- Hidden input field for updation row data -->
                <input type="hidden" name="row-id" id="row-id" />

                <div class="mb-2 col-sm-3">
                    <input type="text" name="desc" id="desc" class="form-control" required placeholder="Enter Description">
                </div>
                <div class="mb-2 col-sm-3">
                    <select name="choice" id="choice" class="form-select">
                        <option value="empty" selected>Select Income or Expense</option>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>
                <div class="mb-2 col-sm-2">
                    <input type="submit" class="btn btn-warning mr-4" value="Add Transaction" name="submit_income" id="submit-btn" />
                    <input type="button" class="btn btn-primary mr-4 d-none" value="Update" id="update-btn" />
                </div>
            </div>
        </form>
    </div>

    <!-- Below div for display alert massage -->
    <div class="col-sm-12" id="show-alert"></div>

    <div class="container-fluid mt-5">
        <div class="row border">

            <div class="col-sm-7" id="show-table">
                <!-- Display table using ajax when document loaded -->
                <?php

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
                                   <td class="text-center">
                                        <button class="edit-btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                                        <button class="del-btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
                                   </td>
                                </tr>
                              ';
                    }
                }
                echo '
               </tbody>
          </table>';
                ?>
            </div>

            <div class="col-sm-4 mt-3">
                <h2>Your Balance</h2>
                <div class="mt-4">
                    <p class="fs-4">Total Balance is: <span class="fw-bold"><?php echo number_format($total_income - $total_exp); ?></span>
                    </p>
                </div>
                <div>

                    <button class="btn btn-warning">Income =
                        <?php if (isset($total_income)) echo number_format($total_income); ?></button>
                    <button class="btn btn-danger">Expence =
                        <?php if (isset($total_exp)) echo number_format($total_exp); ?></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="app.js"></script>
    <script>
        // Delete Transaction record code start here
        let delBtn = Array.from(document.getElementsByClassName('del-btn'));
        let showMsg = document.getElementById('success-box');
        delBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let choice = confirm("Are you sure delete this record");
                if (choice) {
                    let delId = btn.parentElement.parentElement.children[0].textContent;
                    let formData = new FormData();

                    formData.append('delete', 1);
                    formData.append('delId', delId);

                    fetch('partial/_actionTable.php', {
                            header: {},
                            method: 'POST',
                            body: formData
                        }).then(res => res.text())
                        .then(data => {
                            showMsg.classList.remove('d-none');
                            showMsg.firstElementChild.innerHTML = data;
                            console.log(data);
                        })
                }
            });
        })
        // Delete Transaction record code End here
    </script>
</body>

</html>