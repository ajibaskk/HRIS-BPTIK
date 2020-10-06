            </div>

            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0
                    <br>Dibuat dengan penuh rasa  
                    <i class="fa fa-heart" style="font-size:12px;color:red"></i>
                    <br>Created by Fauzan & Aji & Fredo & Ikram
                </div>
                <strong>TIM IT UNDIP &copy; 2020 <a hrf="<?= base_url(); ?>">BPTIK Jawa Tengah</a>.</strong>
                <br>All rights reserved.
                <br>CV Project Manager : <a href="https://d4rabi.github.io/CV/">Fauzan Idal Fithri El Ardhi</a>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

    <?php
    if (isset($js)) {
        foreach ($js as $j) {
            echo '<script src="' . $j . '"></script>';
        }
    }
    ?>

    </body>

</html>