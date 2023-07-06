    <body>
        <!-- Display events -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Events</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($newEvents as $event) {
                                echo "<tr>";
                                echo "<td>" . $event->getSubject() . "</td>";
                                echo "<td>" . $event->getStart()->getDateTime() . "</td>";
                                echo "<td>" . $event->getEnd()->getDateTime() . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>