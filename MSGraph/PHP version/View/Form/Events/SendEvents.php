<?php include 'include/header.php'; ?>
<h1>Send events</h1>
       <!-- Form post -->
        <form  method="POST" action="">
            <!-- Field texte -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>
                <!-- Field select -->
                <div class="form-group">
                <label for="reminder">Reminder</label>
                <select class="form-control" id="reminderMinutesBeforeStart" name="reminderMinutesBeforeStart">
                    <!-- Field option -->
                    <option value="0">No reminder</option>
                    <option value="15">15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="60">1 hour</option>
                    <option value="120">2 hours</option>
                    <option value="1440">1 day</option>
                    <option value="2880">2 days</option>
                    <option value="4320">3 days</option>
                    <option value="10080">1 week</option>
                </select>
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" class="form-control" id="body" name="body" placeholder="Body">
            </div>
            <!-- Field date -->
            <div class="form-group">
                <label for="start">Start</label>
                <input type="date" class="form-control" id="start" name="start" placeholder="Start">
            </div>
            <div class="form-group">
                <label for="end">End</label>
                <input type="date" class="form-control" id="end" name="end" placeholder="End">
            </div>
            <!-- Button submit -->
            <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>