<?php

require_once "engine/config.php";

$employees = [];

$link = mysqli_connect('localhost', DB_user, DB_pass, DB_name);

mysqli_set_charset($link, "utf8");

$query = "SELECT * FROM employees;";

$sql = mysqli_query($link, $query);
$result = [];
if ($sql !== false) {
    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $result[] = $row;
    }
}

$employees = $result;

mysqli_close($link);

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("image/1.png");
            background-size: cover;
            background-attachment: fixed;

        }
    </style>

    <title>Document</title>
</head>
<body>

<nav class="text-center text-white navbar navbar-expand-lg navbar-light bg-light"
     style="background-color:#563d7c !important">
    <a class="navbar-brand w-100" href="#" style="font-size:1.7rem; color: #fff;">Web-разработка информационной
        подсистемы по учету персонала</a>
</nav>

<ul class="mt-4 justify-content-center nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a aria-controls="Сотрудники" aria-selected="true" class="nav-link active" data-toggle="tab" href="#home" id="home-tab"
           role="tab">Сотрудники</a>
    </li>
    <li class="nav-item" role="presentation">
        <a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab" href="#profile" id="profile-tab"
           role="tab">Добавить сотрудника</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home" role="tabpanel">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <table class="table mt-1 bg-light">

                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Должность</th>
                            <th>Телефон</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employees as $key => $employee): ?>
                            <tr>
                                <th scope="row"><?php echo $key+1; ?></th>
                                <td><?php echo $employee['lastName'] . " " . $employee['fistName'] . " " . $employee['middleName']?></td>
                                <td><?php echo $employee['position']?></td>
                                <td><?php echo $employee['phone']?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div aria-labelledby="profile-tab" class="tab-pane fade" id="profile" role="tabpanel">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-1">
                    <section class="p-4">
                        <div class="card">
                            <h5 class="card-header">Создать нового пользователя</h5>
                            <div class="card-body">
                                <form action="engine/EmployeeStoreRequest.php" class="needs-validation" id="new_user_form" method="POST" novalidate>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="" for="validationCustom01">Имя</label>
                                            <input class="form-control" id="validationCustom01" name="firstName"
                                                   placeholder="Имя" required type="text" value="Айгуль">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom02">Фамилия</label>
                                            <input class="form-control" id="validationCustom02" name="lastName"
                                                   placeholder="Фамилия" required type="text" value="Гарифьянова">

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Отчество</label>
                                            <input class="form-control" id="validationCustom03" name="middleName"
                                                   placeholder="Отчество" required type="text" value="Маратовна">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustomUsername">Email</label>
                                            <div class="input-group">
                                                <input aria-describedby="inputGroupPrepend" class="form-control" id="validationCustomUsername"
                                                       name="email" placeholder="Email"
                                                       required type="text">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Семейное положение </label>
                                            <input aria-describedby="inputGroupPrepend" class="form-control" id="validationCustom04"
                                                   name="family" placeholder="Семейное положение"
                                                   required type="text">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom06">Серия и номер паспорта</label>
                                            <input class="form-control" id="validationCustom05" name="pass"
                                                   placeholder="Серия и номер паспорта" required type="text">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-2">
                                            <label for="validationCustom05">Телефон</label>
                                            <input class="form-control" id="validationCustom06" name="phone"
                                                   placeholder="Телефон" type="text" value="">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-8">
                                                <div class="form-check-label">Образование:</div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio1" name="education" required
                                                           type="radio" value="Среднее специальное">
                                                    <label class="custom-control-label" for="customRadio1">Среднее
                                                        специальное;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio2" name="education" required
                                                           type="radio" value="Высшее образование - бакалавриат">
                                                    <label class="custom-control-label" for="customRadio2">Высшее
                                                        образование - бакалавриат;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio3" name="education" required
                                                           type="radio" value="Высшее образование - специалитет, магистратура">
                                                    <label class="custom-control-label" for="customRadio3">Высшее
                                                        образование - специалитет, магистратура;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio4" name="education" required
                                                           type="radio" value="Высшее образование - подготовка кадров высшей квалификации">
                                                    <label class="custom-control-label" for="customRadio4">Высшее
                                                        образование - подготовка кадров высшй квалификации.</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check-label">Должность:</div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio6" name="position" required
                                                           type="radio" value="Руководитель центра">
                                                    <label class="custom-control-label" for="customRadio6">Руководитель
                                                        центра;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio7" name="position" required
                                                           type="radio" value="Менеджер по персоналу">
                                                    <label class="custom-control-label" for="customRadio7">Менеджер по
                                                        персоналу;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio8" name="position" required
                                                           type="radio" value="Программист">
                                                    <label class="custom-control-label"
                                                           for="customRadio8">Программист;</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="customRadio9" name="position" required
                                                           type="radio" value="Бухгалтер">
                                                    <label class="custom-control-label"
                                                           for="customRadio9">Бухгалтер.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-4 "
                                                style="background-color:#563d7c !important" type="submit">Создать
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


    </div>

    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>