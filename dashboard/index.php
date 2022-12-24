<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole
// | @author_url    : https://www.logad.net
// | @author_email  : michael@logad.net
// | @date          : 24 Dec, 2022 4:42 PM
// +------------------------------------------------------------------------+

// +----------------------------+
// | 
// +----------------------------+

require __DIR__. '/../vendor/autoload.php';

use Michaelthedev\Workershifts\Admin;
use Michaelthedev\Workershifts\Helper;
use Michaelthedev\Workershifts\Worker;

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Admin::handleFormSubmit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<style type="text/css">
        /* Webpixels CSS */
        /* Utility and component-centric Design System based on Bootstrap for fast, responsive UI development */
        /* URL: https://github.com/webpixels/css */
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);
        /* Bootstrap Icons */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
	</style>
</head>
<body>

<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight">Workers Shifts</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end">
                            <div class="mx-n1">
                                <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-pencil"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                                <a href="#" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Create</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Nav -->
                    <ul class="nav nav-tabs mt-4 overflow-x border-0">
                        <li class="nav-item ">
                            <a href="#" class="nav-link active">Summary</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">Workers</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">Shifts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Workers</span>
                                        <span class="h3 font-bold mb-0"><?=$admin->getTotalWorkers()?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>13%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Shifts</span>
                                        <span class="h3 font-bold mb-0"><?=$admin->getTotalWorkersShifts()?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                            <i class="bi bi-minecart-loaded"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>10%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total hours</span>
                                        <span class="h3 font-bold mb-0"><?=$admin->getTotalWorkersShiftHours()?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                        <i class="bi bi-arrow-down me-1"></i>-5%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add worker & add work shift forms -->
                <div class="row my-5">
                    <div class="col-lg-8">
                        <h1 class="lh-tight ls-tighter font-bolder h2 mb-2">
                            Representations
                        </h1>
                        <p class="text-sm">
                            Table of all workers and calendar of shifts
                        </p>
                    </div>
                </div>
                <!-- All workers table -->
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">Workers</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Worker ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Joined</th>
                                    <th scope="col">Total Shifts</th>
                                    <th scope="col">Total Hours</th>
                                    <th scope="col">Last Shift</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($admin->getAllWorkers() as $worker):
                                    $workerObj = new Worker($worker->worker_id);
                                    $lastShift = $workerObj->getLastWorkShift();
                                    ?>
                                <tr>
                                    <td><?=$worker->worker_id?></td>
                                    <td>
                                        <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="#">
                                            <?=$worker->first_name?> <?=$worker->last_name?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= Helper::formatTimeStamp($worker->date)?>
                                    </td>
                                    <td><?=$workerObj->getTotalWorkShifts()?></td>
                                    <td><?=$workerObj->getTotalWorkHours()?> hours</td>
                                    <td>
                                        <?php if (!empty($lastShift)):?>
                                        <span class="badge badge-lg badge-dot">
                                            <i class="<?=(time() > $lastShift->start_time) ? (($lastShift->status == 'present') ? 'bg-success' : 'bg-danger') : 'bg-warning'?>"></i><?=Helper::formatTimeStamp($lastShift->date)?>
                                        </span>
                                        <?php endif;?>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                        <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                    </div>
                </div>

                <!-- All shifts table -->
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">Shifts</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Shift ID</th>
                                    <th scope="col">Worker ID</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($admin->getAllWorkShifts() as $shift):
                                    ?>
                                <tr>
                                    <td><?=$shift->shift_id?></td>
                                    <td><?=$shift->worker_id?></td>
                                    <td><?= Helper::formatTimeStamp($shift->start_time, 'd M, Y h:ia')?></td>
                                    <td><?= Helper::formatTimeStamp($shift->end_time, 'd M, Y h:ia')?></td>
                                    <td><?=$shift->duration?> hours</td>
                                    <td>
                                        <span class="badge <?=(time() > $shift->start_time) ? (($shift->status == 'present') ? 'bg-success' : 'bg-danger') : 'bg-warning'?>"><?=(time() > $shift->start_time) ? (($shift->status == 'present') ? 'present' : 'missed') : 'pending'?></span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                        <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                    </div>
                </div>

                <!-- Add worker & add work shift forms -->
                <div class="row my-5">
                    <div class="col-lg-8">
                        <h1 class="lh-tight ls-tighter font-bolder h2 mb-2">
                            Working Forms
                        </h1>
                        <p class="text-sm">
                            You can use the forms below to create workers and work shifts
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Add Worker</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="./">
                                    <div class="mb-5">
                                        <label class="form-label">First name</label>
                                        <input type="text" class="form-control" name="first_name"/>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Last name</label>
                                        <input type="text" class="form-control" name="last_name"/>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="role_default" selected="selected">Shift Worker</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="submittedFormType" value="createWorker">
                                    <button type="submit" class="btn btn-primary w-full">Create Worker</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-1">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Add Work Shift</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="./">
                                    <div class="mb-5">
                                        <label class="form-label">Shift Worker</label>
                                        <select class="form-select" aria-label="Default select example" name="worker_id">
                                            <option value="" selected="selected">Select Worker</option>
                                            <?php foreach ($admin->getAllWorkers() as $worker):?>
                                            <option value="<?=$worker->worker_id?>"><?=$worker->first_name?> <?=$worker->last_name?> (<?=$worker->worker_id?>)</option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label class="form-label">Duration</label>
                                        <input type="text" class="form-control" value="<?=Helper::workShiftDuration?> hours" readonly disabled/>
                                    </div>

                                    <div class="mb-5">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="start_date"/>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Shift Time</label>
                                        <select name="start_time" class="form-select">
                                            <option value="0:00">0 - 8</option>
                                            <option value="8:00">8 - 16</option>
                                            <option value="16:00">16 - 24</option>
                                        </select>
                                    </div>
                                    <!--<div class="mb-5">
                                        <label class="form-label">End Time</label>
                                        <input type="time" id="endTimeInput" class="form-control" readonly disabled/>
                                    </div>-->
                                    <input type="hidden" name="submittedFormType" value="createWorkShift">
                                    <button type="submit" class="btn btn-dark w-full">Create Work Shift</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Return message alerts -->
<script type="text/javascript">
    <?php if (!empty($_GET['returnMsg'])):
    $returnMsg = htmlentities($_GET['returnMsg']);?>
    alert('Response: <?=$returnMsg?>');
    window.location.href = './';
    <?php endif;?>
</script>
</body>
</html>

