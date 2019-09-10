<?php $this->layout('layouts/admin', [
    'title' => 'Admin Dashboard'
]) ?>

    <h2 class="page-title">Dashboard</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body bk-primary text-light">
                            <div class="stat-panel text-center">
                                <div class="stat-panel-number h1 "><?= $this->e($bg); ?></div>
                                <div class="stat-panel-title text-uppercase">Total Users</div>
                            </div>
                        </div>
                        <a href="userlist.php" class="block-anchor panel-footer">Full Detail
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body bk-success text-light">
                            <div class="stat-panel text-center">
                                <div class="stat-panel-number h1 "><?= $this->e($regbd); ?></div>
                                <div class="stat-panel-title text-uppercase">Feedback Messages</div>
                            </div>
                        </div>
                        <a href="feedback.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body bk-danger text-light">
                            <div class="stat-panel text-center">
                                <div class="stat-panel-number h1 "><?= $this->e($regbd2); ?></div>
                                <div class="stat-panel-title text-uppercase">Notifications</div>
                            </div>
                        </div>
                        <a href="notification.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body bk-info text-light">
                            <div class="stat-panel text-center">
                                <div class="stat-panel-number h1 "><?= $this->e($query); ?></div>
                                <div class="stat-panel-title text-uppercase">Deleted Users</div>
                            </div>
                        </div>
                        <a href="deleteduser.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->push('before_body_close') ?>
    <script>
        window.onload = function () {

            // Line chart from swirlData for dashReport
            var ctx = document.getElementById("dashReport").getContext("2d");
            window.myLine = new Chart(ctx).Line(swirlData, {
                responsive: true,
                scaleShowVerticalLines: false,
                scaleBeginAtZero: true,
                multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            });

            // Pie Chart from doughutData
            var doctx = document.getElementById("chart-area3").getContext("2d");
            window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive: true});

            // Dougnut Chart from doughnutData
            var doctx = document.getElementById("chart-area4").getContext("2d");
            window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive: true});
        }
    </script>
<?php $this->end() ?>