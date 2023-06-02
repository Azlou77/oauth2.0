 <!-- The Modal -->
 <div class="modal" id="myModal">
   <div class="modal-dialog modal-dialog-centered">

    <!-- Form post -->a
    <form  method="POST" action="">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add an event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
        
            <!-- Input subject-->
                <div class="mb-3">
                    <label for="" class="form-label">subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
            </div>
        
                <!-- Input  body-->
                <div class="mb-3">
                    <label for="body" class="form-label">body</label>
                    <input type="text" class="form-control" id="body" name="body" placeholder="Enter body">
                </div>
            
        
                <!-- Email attendees-->
                <div class="mb-3">
                    <label for="attendees" class="form-label">attendees</label>
                    <input type="email" class="form-control" id="attendees" name="attendees" placeholder="Enter attendees">
                </div>
        
                <!-- Input start date-->
                <div class="mb-3">
                    <label for="start" class="form-label">Start date</label>
                    <input type="date" class="form-control" id="start" name="start">
                </div>

                <!-- Input end date-->
                <div class="mb-3">
                    <label for="end" class="form-label">End date</label>
                    <input type="date" class="form-control" id="end" name="end">
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit"  class="btn btn-primary"  data-dismiss="modal">Enregistrer</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
    </div>
</div>   








?>
